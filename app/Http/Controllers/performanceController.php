<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataset_panen;
use App\Models\datauji;
use App\Models\performance;
use Phpml\Classification\NaiveBayes;

class performanceController extends Controller
{
    public function performance(){
        $total_data_latih = dataset_panen::all()->count();
        $total_data_uji = datauji::all()->count();

        $dataLatih = dataset_panen::all();
        $dataUji = datauji::all();
        // Mengubah data latih dan data uji menjadi format yang dapat digunakan oleh library PHP ML Naive Bayes
        $dataLatihFitur = [];
        $dataLatihLabel = [];
        foreach ($dataLatih as $data) {
            $dataLatihFitur[] = [$data->luas_tanam, $data->kondisi_lahan, $data->kondisi_daun, $data->pupuk, $data->hama];
            $dataLatihLabel[] = $data->hasil;
        }

        $dataUjiFitur = [];
        $dataUjiLabel = [];
        foreach ($dataUji as $data) {
            $dataUjiFitur[] = [$data->luas_tanam, $data->kondisi_lahan, $data->kondisi_daun, $data->pupuk, $data->hama];
            $dataUjiLabel[] = $data->hasil;
        }

        // Membangun model Naive Bayes
        $naiveBayes = new NaiveBayes();
        $naiveBayes->train($dataLatihFitur, $dataLatihLabel);

        // Memprediksi hasil panen untuk data uji
        $prediksi = $naiveBayes->predict($dataUjiFitur);

        // Menghitung tingkat akurasi
        $akurasi = 0;
        for ($i = 0; $i < count($prediksi); $i++) {
            if ($prediksi[$i] == $dataUjiLabel[$i]) {
                $akurasi++;
            }
        }

        $akurasi = $akurasi / count($dataUji) * 100;

        // Menghitung tingkat recall
        $recall = 0;
        $positifBenar = 0;
        $positifAktual = 0;
        for ($i = 0; $i < count($prediksi); $i++) {
            if ($dataUjiLabel[$i] == $data->hasil) {
                $positifAktual++;
                if ($prediksi[$i] == $data->hasil) {
                    $positifBenar++;
                }
            }
        }
        if ($positifAktual > 0) {
            $recall = $positifBenar / $positifAktual * 100;
        }
        // Menghitung precision
        $precision = 0;
        $positifPrediksi = 0;
            for ($i = 0; $i < count($prediksi); $i++) {
                if ($prediksi[$i] == $data->hasil) {
                    $positifPrediksi++;
                }
            }
            if ($positifPrediksi > 0) {
                $precision = $positifBenar / $positifPrediksi * 100;
        }
        $lastPerformance = performance::latest()->first();

    $TP = 0;
    $TN = 0;
    $FP = 0;
    $FN = 0;

    // Calculate TP, TN, FP, FN
    for ($i = 0; $i < count($prediksi); $i++) {
        if ($prediksi[$i] == $data->hasil && $dataUjiLabel[$i] == $data->hasil) {
            $TP++;
        } elseif ($prediksi[$i] != $data->hasil && $dataUjiLabel[$i] != $data->hasil) {
            $TN++;
        } elseif ($prediksi[$i] == $data->hasil && $dataUjiLabel[$i] != $data->hasil) {
            $FP++;
        } elseif ($prediksi[$i] != $data->hasil && $dataUjiLabel[$i] == $data->hasil) {
            $FN++;
        }
    }

        // Membandingkan nilai akurasi dan recall baru dengan nilai terakhir
        if (!$lastPerformance || $lastPerformance->akurasi != $akurasi || $lastPerformance->recall != $recall) {
            // Jika ada perubahan, simpan data performa baru ke database
            $performanceRecord = new performance();
            $performanceRecord->total_data_latih = $total_data_latih;
            $performanceRecord->total_data_uji = $total_data_uji;
            $performanceRecord->akurasi = $akurasi;
            $performanceRecord->recall = $recall;
            $performanceRecord->presisi = $precision;
            $performanceRecord->save();
        }

        return view('performance', compact('total_data_latih', 'total_data_uji',
         'akurasi','recall', 'precision', 'TP', 'TN', 'FP', 'FN'));
    }
}
