<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataset_panen;
use App\Models\petani;

class panenController extends Controller
{
    public function panen(){
        $varpanen = dataset_panen::with('petani')->orderBy('id','desc')->paginate(10);
        return view('panen.data_panen', compact('varpanen'));
    }

    public function Tambahpanen(){
        $show1 = petani::orderBy('nama', 'asc')->get();
        return view('panen.tambah_data_panen', compact('show1'));
    }

    public function Simpanpanen(Request $request){
        $luas_tanam = $request->luas_tanam;
        $pupuk = $request->pupuk;
        $hasil = $request->hasil;
    
        // Logika untuk menentukan kategori luas_tanam
        if ($luas_tanam >= 2) {
            $luas_tanam_kategori = 'Luas';
        } elseif ($luas_tanam >= 1) {
            $luas_tanam_kategori = 'Sedang';
        } else {
            $luas_tanam_kategori = 'Sempit';
        }

        // Logika untuk menentukan kategori pupuk
        if ($pupuk >= 500) {
            $pupuk_kategori = 'Banyak';
        } elseif ($pupuk >= 250) {
            $pupuk_kategori = 'Cukup';
        } else {
            $pupuk_kategori = 'Kurang';
        }

        // Logika untuk menentukan kategori hasil
        if ($hasil >= 3.8) {
            $hasil_kategori = 'Meningkat';
        }  else {
            $hasil_kategori = 'Menurun';
        }
    
        // Simpan ke database dengan kategori luas_tanam
        dataset_panen::create([
            'nik_petani'=> $request->nik_petani,
            'luas_tanam' => $luas_tanam_kategori,
            'kondisi_lahan' => $request->kondisi_lahan,
            'kondisi_daun' => $request->kondisi_daun,
            'pupuk' => $pupuk_kategori,
            'hama' => $request->hama,
            'hasil' => $hasil_kategori,
            'hektar' => $request->luas_tanam,
            'kg' => $request->pupuk,
            'ton' => $request->hasil
        ]);
    
        return redirect('data-panen');
    }

    public function Editpanen($id){
        $varpanen = dataset_panen::where('id', $id)->first();
        $petani = petani::orderBy('nama', 'asc')->get();
        return view('panen.edit_data_panen', compact('varpanen', 'petani'));
    }
    
    public function Perubahanpanen(Request $request, $id){
        $varpanen = dataset_panen::where('id', $id);
        $luas_tanam = $request->luas_tanam;
        $pupuk = $request->pupuk;
        $hasil = $request->hasil;
    
        // Logika untuk menentukan kategori luas_tanam
        if ($luas_tanam >= 2) {
            $luas_tanam_kategori = 'Luas';
        } elseif ($luas_tanam >= 1) {
            $luas_tanam_kategori = 'Sedang';
        } else {
            $luas_tanam_kategori = 'Sempit';
        }

        // Logika untuk menentukan kategori pupuk
        if ($pupuk >= 500) {
            $pupuk_kategori = 'Banyak';
        } elseif ($pupuk >= 250) {
            $pupuk_kategori = 'Cukup';
        } else {
            $pupuk_kategori = 'Kurang';
        }

        // Logika untuk menentukan kategori hasil
        if ($hasil >= 3.8) {
            $hasil_kategori = 'Meningkat';
        }  else {
            $hasil_kategori = 'Menurun';
        }
        $data = [
            'luas_tanam' => $luas_tanam_kategori,
            'kondisi_lahan' => $request->kondisi_lahan,
            'kondisi_daun' => $request->kondisi_daun,
            'pupuk' => $pupuk_kategori,
            'hama' => $request->hama,
            'hasil' => $hasil_kategori,
            'hektar' => $request->luas_tanam,
            'kg' => $request->pupuk,
            'ton' => $request->hasil
        ];

        $varpanen->update($data);
       return redirect('data-panen');
    } 

    public function Hapuspanen($id)
    {
        $varpanen = dataset_panen::where('id' ,$id);
        $varpanen->delete();
        return back();
    }
}
