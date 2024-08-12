<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataset_panen;
use App\Models\hasil_prediksi;
use App\Models\user;
use App\Models\desa;
use App\Models\ppl;
use Auth;

class prediksiController extends Controller
{
  public function prediksi()
  {
    $user = Auth::user();
    $nama = $user->name;
    $desa = $user->desa()->first();
    return view('prediksi.userprediksi', compact('nama', 'desa'));
  }

  public function hasilPrediksi(Request $request)
  {
      $user_id = Auth::user()->id;
      $nama = Auth::user()->name;
      $desa_id = Auth::user()->desa_id;
      $nik = Auth::user()->nik_petani; // Asumsikan user model memiliki kolom 'nik'

    // Dapatkan luas tanam maksimum dari dataset berdasarkan NIK petani
    $max_luas_tanam = dataset_panen::where('nik_petani', $nik)->max('hektar');

    // Jika tidak ada data untuk NIK ini, gunakan nilai default atau kembalikan error
    if ($max_luas_tanam === null) {
        return redirect()->back()->with('error', "Tidak ada data luas tanam untuk petani ini.");
    }

    $luas_tanam = $request->luas_tanam;
    
    // Validasi dan batasi input luas tanam
    if ($luas_tanam > $max_luas_tanam) {
        // Opsi 1: Kembalikan pesan error
        return redirect()->back()->with('error', "Luas tanam tidak boleh melebihi $max_luas_tanam hektar untuk petani ini.");
        
        // Opsi 2: Batasi nilai input ke nilai maksimum
        // $luas_tanam = $max_luas_tanam;
    }
      $luas_tanam = $request->luas_tanam;
      $pupuk = $request->pupuk;
      $kondisi_lahan = $request->kondisi_lahan;
      $kondisi_daun = $request->kondisi_daun;
      $hama = $request->hama; 
  
      if ($luas_tanam >= 2) {
          $luas_tanam_kategori = 'Luas';
      } elseif ($luas_tanam >= 1) {
          $luas_tanam_kategori = 'Sedang';
      } else {
          $luas_tanam_kategori = 'Sempit';
      }
  
      if ($pupuk >= 500) {
          $pupuk_kategori = 'Banyak';
      } elseif ($pupuk >= 250) {
          $pupuk_kategori = 'Cukup';
      } else {
          $pupuk_kategori = 'Kurang';
      }
    
      $data = [
          'user_id' => $user_id,
          'nama' => $nama,
          'desa_id' => $desa_id,
          'luas_tanam' => $luas_tanam_kategori,
          'kondisi_lahan' => $kondisi_lahan,
          'kondisi_daun' => $kondisi_daun,
          'pupuk' => $pupuk_kategori,
          'hama' => $hama,
      ];
  
      $total_data = dataset_panen::all()->count();
  
      // Hitung probabilitas hasil panen meningkat
      $data_meningkat = dataset_panen::where('hasil', 'meningkat')->count();
      $probabilitas_meningkat = $data_meningkat / $total_data;
  
      // Hitung probabilitas hasil panen menurun
      $data_menurun = dataset_panen::where('hasil', 'menurun')->count();
      $probabilitas_menurun = $data_menurun / $total_data;
  
      //menghitung probabilitas setiap atribut yang mana hasil panen meningkat
      $probabilitas_luas_tanam_meningkat = dataset_panen::where('luas_tanam', $data['luas_tanam'])->where('hasil', 'meningkat')->count();
      $hasil_probabilitas_luas_tanam = round($probabilitas_luas_tanam_meningkat / $data_meningkat, 2);
  
      $probabilitas_kondisi_lahan_meningkat = dataset_panen::where('kondisi_lahan', $data['kondisi_lahan'])->where('hasil', 'meningkat')->count();
      $hasil_probabilitas_kondisi_lahan = round($probabilitas_kondisi_lahan_meningkat / $data_meningkat, 2);
  
      $probabilitas_kondisi_daun_meningkat = dataset_panen::where('kondisi_daun', $data['kondisi_daun'])->where('hasil', 'meningkat')->count();
      $hasil_probabilitas_kondisi_daun = round($probabilitas_kondisi_daun_meningkat / $data_meningkat, 2);
  
      $probabilitas_pupuk_meningkat = dataset_panen::where('pupuk', $data['pupuk'])->where('hasil', 'meningkat')->count();
      $hasil_probabilitas_pupuk = round($probabilitas_pupuk_meningkat / $data_meningkat, 2);
  
      $probabilitas_hama_meningkat = dataset_panen::where('hama', $data['hama'])->where('hasil', 'meningkat')->count();
      $hasil_probabilitas_hama = round($probabilitas_hama_meningkat / $data_meningkat, 2);
  
      //menghitung probabilitas setiap atribut yang mana hasil panen menurun
      $probabilitas_luas_tanam_menurun = dataset_panen::where('luas_tanam', $data['luas_tanam'])->where('hasil', 'menurun')->count();
      $hasil_probabilitas_luas_tanam_menurun = round($probabilitas_luas_tanam_menurun / $data_menurun, 2);
  
      $probabilitas_kondisi_lahan_menurun = dataset_panen::where('kondisi_lahan', $data['kondisi_lahan'])->where('hasil', 'menurun')->count();
      $hasil_probabilitas_kondisi_lahan_menurun = round($probabilitas_kondisi_lahan_menurun / $data_menurun, 2);
  
      $probabilitas_kondisi_daun_menurun = dataset_panen::where('kondisi_daun', $data['kondisi_daun'])->where('hasil', 'menurun')->count();
      $hasil_probabilitas_kondisi_daun_menurun = round($probabilitas_kondisi_daun_menurun/ $data_menurun, 2);
  
      $probabilitas_pupuk_menurun = dataset_panen::where('pupuk', $data['pupuk'])->where('hasil', 'menurun')->count();
      $hasil_probabilitas_pupuk_menurun = round($probabilitas_pupuk_menurun / $data_menurun, 2);
  
      $probabilitas_hama_menurun = dataset_panen::where('hama', $data['hama'])->where('hasil', 'menurun')->count();
      $hasil_probabilitas_hama_menurun = round($probabilitas_hama_menurun / $data_menurun, 2);
  
      // mengalikan nilai semua nilai setiap hasil probabilitas dari setiap atribut yang meningkat dan menurun
      $posterior_meningkat = $hasil_probabilitas_luas_tanam * $hasil_probabilitas_kondisi_lahan * $hasil_probabilitas_kondisi_daun * $hasil_probabilitas_pupuk * $hasil_probabilitas_hama;
      $posterior_menurun = $hasil_probabilitas_luas_tanam_menurun * $hasil_probabilitas_kondisi_lahan_menurun * $hasil_probabilitas_kondisi_daun_menurun * $hasil_probabilitas_pupuk_menurun * $hasil_probabilitas_hama_menurun;
      
      if ($posterior_meningkat > $posterior_menurun) 
      {
          $prediksi = "Meningkat";
      } else {
          $prediksi = "Menurun";
      }
  
      // Konversi hasil prediksi ke numerik
      $prediksi_numerik = $this->categoryToNumeric($prediksi, $luas_tanam, $pupuk, $kondisi_lahan, $kondisi_daun, $hama);
  
      $saran = '';
  
      if ($prediksi == "Menurun") {
          if ($data['pupuk'] == 'Kurang') {
              $saran .= "- Tingkatkan pemberian pupuk. Pastikan dosis dan jenis pupuk sesuai dengan kebutuhan tanaman. Pertimbangkan untuk melakukan pemupukan berimbang dengan memperhatikan unsur N, P, dan K.\n";
          }
  
          if ($data['hama'] == 'Terserang') {
              $saran .= "- Lakukan pengendalian hama segera. Gunakan pestisida yang sesuai atau metode pengendalian yang optimal.\n";
          }

          if ($data['kondisi_daun'] == 'Kuning Layu') {
            $saran .= "- Atasi masalah pada daun tanaman. Periksa kemungkinan serangan penyakit atau kekurangan nutrisi. Aplikasikan fungisida jika diperlukan dan berikan pupuk daun yang sesuai.\n";
        }
  
          if ($data['kondisi_lahan'] == 'Banjir' || $data['kondisi_lahan'] == 'Kering') {
              $saran .= "- Perbaiki kondisi lahan Anda. atur drainase.\n";
          }
  
          if ($data['luas_tanam'] == 'Sempit' || $data['luas_tanam'] == 'Sedang') {
              $saran .= "- Evaluasi kembali luas tanam Anda. Sesuaikan dengan kapasitas perawatan dan sumber daya yang tersedia. Pertimbangkan untuk mengoptimalkan penggunaan lahan dengan teknik penanaman yang efisien.\n";
          }
  
          if (!empty($saran)) {
              $saran = "Hasil panen diprediksi menurun. Berikut saran untuk meningkatkan hasil panen:\n" . $saran;
          } else {
              $saran = "Hasil panen diprediksi menurun, namun tidak ada saran spesifik berdasarkan input Anda. Tetap pantau dan jaga kualitas perawatan tanaman Anda.";
          }
      } else {
          $saran = "Hasil panen diprediksi meningkat. Pertahankan praktik pertanian yang baik. Tetap pantau dan jaga kualitas perawatan tanaman Anda.";
      }
  
      $prediksiPanen = new hasil_prediksi();
      $prediksiPanen->user_id = $user_id;
      $prediksiPanen->nama = $nama;
      $prediksiPanen->desa_id = $desa_id;
      $prediksiPanen->luas_tanam = $luas_tanam;
      $prediksiPanen->kondisi_lahan = $kondisi_lahan;
      $prediksiPanen->kondisi_daun = $kondisi_daun;
      $prediksiPanen->pupuk = $pupuk;
      $prediksiPanen->hama = $hama;
      $prediksiPanen->saran = $saran;
      $prediksiPanen->hasil = $prediksi;
      $prediksiPanen->hasil_numerik = $prediksi_numerik;
      $prediksiPanen->save();
  
      return view('prediksi.uprediksi', compact('prediksi', 'prediksi_numerik', 'nama', 'desa_id',
       'luas_tanam', 'kondisi_lahan', 'kondisi_daun', 'hama', 'pupuk',
      'posterior_meningkat', 'posterior_menurun', 'saran'));
  }

  private function categoryToNumeric($category, $luas_tanam, $pupuk, $kondisi_lahan, $kondisi_daun, $hama) {
    $ranges = [
        'Meningkat' => [3.8, 4.3],  // dalam ton
        'Menurun' => [2.0, 3.7]     // dalam ton
    ];

    $range = $ranges[$category];

    // Faktor luas tanam (tetap seperti awal)
    if ($category == 'Meningkat') {
        $multiplier = 1;
        if ($luas_tanam > 0.1 && $luas_tanam == 1) {
            $multiplier = 1;  // Tidak ada perubahan untuk 1 hektar
        } elseif ($luas_tanam > 1 && $luas_tanam < 2) {
            $multiplier = 1.1;  // Untuk luas tanam antara 1 dan 2 hektar, termasuk 1.5
        } elseif ($luas_tanam > 2 && $luas_tanam < 3) {
            $multiplier = 1.2;  // Untuk luas tanam antara 2 dan 3 hektar
        } elseif ($luas_tanam > 3 && $luas_tanam < 4) {
            $multiplier = 1.4;  // Untuk luas tanam antara 3 dan 4 hektar
        } elseif ($luas_tanam >= 4) {
            $multiplier = 2.5;
        }
    
        $range[0] *= $multiplier;
        $range[1] *= $multiplier;
    }

    // Faktor tambahan
    $additional_multiplier = 1;

    // Faktor pupuk
    if ($pupuk >= 500) {
        $additional_multiplier *= 1.1;
    } elseif ($pupuk >= 250) {
        $additional_multiplier *= 1;
    }

    // Faktor kondisi lahan
    if ($kondisi_lahan == 'Bagus') {
        $additional_multiplier *= 1;
    } elseif ($kondisi_lahan == 'Banjir') {
        $additional_multiplier *= 0.9;
    } elseif ($kondisi_lahan == 'Kering') {
        $additional_multiplier *= 0.9;
    }

    // Faktor kondisi daun
    if ($kondisi_daun == 'Hijau Sehat') {
        $additional_multiplier *= 1;
    } elseif ($kondisi_daun == 'Kuning Layu') {
        $additional_multiplier *= 0.9;
    }

    // Faktor hama
    if ($hama == 'Tidak Terserang') {
        $additional_multiplier *= 1.1;
    } elseif ($hama == 'Terserang') {
        $additional_multiplier *= 0.95;
    }

    // Terapkan additional multiplier
    $range[0] *= $additional_multiplier;
    $range[1] *= $additional_multiplier;

    return round(mt_rand($range[0] * 1000, $range[1] * 1000) / 1000, 3);
}

  public function lihatDetailUser(Request $request)
  {
      // Ambil data prediksi berdasarkan ID
      $prediksi = hasil_prediksi::with('desa.ppl')->where('user_id', $request->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->first();


      return view('prediksi.hasiluser', compact('prediksi'));
  }

  public function riwayatPrediksi(Request $request)
  {
      // Ambil data prediksi berdasarkan ID
      $riwayat = hasil_prediksi::with('desa.ppl')->where('user_id', $request->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
      return view('prediksi.riwayat', compact('riwayat'));
  }

  public function detailriwayat(Request $request, $id)
  {
      $detail = hasil_prediksi::where('id', $id)
                        ->where('user_id', $request->user()->id)
                        ->first();
      return view('prediksi.detailriwayat', compact('detail'));
  }
  

  public function prediksiadmin()
  {
    $user = Auth::user();
    $nama = $user->name;
    $desa = desa::all();
    return view('prediksi.adminprediksi', compact('nama', 'desa'));
  }

  public function hasilPrediksiAdmin(Request $request)
  {
    $user_id = Auth::user()->id;
    $nama = Auth::user()->name;
    $desa_id = $request->desa_id;
    $luas_tanam = $request->luas_tanam;
    $pupuk = $request->pupuk;
    $kondisi_lahan = $request->kondisi_lahan;
    $kondisi_daun = $request->kondisi_daun;
    $hama = $request->hama;

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
  
  $data = [
    'user_id' => $request->user_id,
    'nama' => $request->nama,
    'desa_id' => $request->desa_id,
    'luas_tanam' => $luas_tanam_kategori,
    'kondisi_lahan' => $request->kondisi_lahan,
    'kondisi_daun' => $request->kondisi_daun,
    'pupuk' => $pupuk_kategori,
    'hama' => $request->hama,
];

    $total_data = dataset_panen::all()->count();

    // Hitung probabilitas hasil panen meningkat
    $data_meningkat = dataset_panen::where('hasil', 'meningkat')->count();
    $probabilitas_meningkat = $data_meningkat / $total_data;

    // Hitung probabilitas hasil panen menurun
    $data_menurun = dataset_panen::where('hasil', 'menurun')->count();
    $probabilitas_menurun = $data_menurun / $total_data;

    //menghitung probabilitas setiap atribut yang mana hasil panen meningkat
    $probabilitas_luas_tanam_meningkat = dataset_panen::where('luas_tanam', $data['luas_tanam'])->where('hasil', 'meningkat')->count();
    $hasil_probabilitas_luas_tanam = round($probabilitas_luas_tanam_meningkat / $data_meningkat, 2);

    $probabilitas_kondisi_lahan_meningkat = dataset_panen::where('kondisi_lahan', $data['kondisi_lahan'])->where('hasil', 'meningkat')->count();
    $hasil_probabilitas_kondisi_lahan = round($probabilitas_kondisi_lahan_meningkat / $data_meningkat, 2);

    $probabilitas_kondisi_daun_meningkat = dataset_panen::where('kondisi_daun', $data['kondisi_daun'])->where('hasil', 'meningkat')->count();
    $hasil_probabilitas_kondisi_daun = round($probabilitas_kondisi_daun_meningkat / $data_meningkat, 2);

    $probabilitas_pupuk_meningkat = dataset_panen::where('pupuk', $data['pupuk'])->where('hasil', 'meningkat')->count();
    $hasil_probabilitas_pupuk = round($probabilitas_pupuk_meningkat / $data_meningkat, 2);

    $probabilitas_hama_meningkat = dataset_panen::where('hama', $data['hama'])->where('hasil', 'meningkat')->count();
    $hasil_probabilitas_hama = round($probabilitas_hama_meningkat / $data_meningkat, 2);

    //menghitung probabilitas setiap atribut yang mana hasil panen menurun
    $probabilitas_luas_tanam_menurun = dataset_panen::where('luas_tanam', $data['luas_tanam'])->where('hasil', 'menurun')->count();
    $hasil_probabilitas_luas_tanam_menurun = round($probabilitas_luas_tanam_menurun / $data_menurun, 2);

    $probabilitas_kondisi_lahan_menurun = dataset_panen::where('kondisi_lahan', $data['kondisi_lahan'])->where('hasil', 'menurun')->count();
    $hasil_probabilitas_kondisi_lahan_menurun = round($probabilitas_kondisi_lahan_menurun / $data_menurun, 2);

    $probabilitas_kondisi_daun_menurun = dataset_panen::where('kondisi_daun', $data['kondisi_daun'])->where('hasil', 'menurun')->count();
    $hasil_probabilitas_kondisi_daun_menurun = round($probabilitas_kondisi_daun_menurun/ $data_menurun, 2);

    $probabilitas_pupuk_menurun = dataset_panen::where('pupuk', $data['pupuk'])->where('hasil', 'menurun')->count();
    $hasil_probabilitas_pupuk_menurun = round($probabilitas_pupuk_menurun / $data_menurun, 2);

    $probabilitas_hama_menurun = dataset_panen::where('hama', $data['hama'])->where('hasil', 'menurun')->count();
    $hasil_probabilitas_hama_menurun = round($probabilitas_hama_menurun / $data_menurun, 2);

    // mengalikan nilai semua nilai setiap hasil probabilitas dari setiap atribut yang meningkat dan menurun
    $posterior_meningkat = $hasil_probabilitas_luas_tanam * $hasil_probabilitas_kondisi_lahan * $hasil_probabilitas_kondisi_daun * $hasil_probabilitas_pupuk * $hasil_probabilitas_hama;
    $posterior_menurun = $hasil_probabilitas_luas_tanam_menurun * $hasil_probabilitas_kondisi_lahan_menurun * $hasil_probabilitas_kondisi_daun_menurun * $hasil_probabilitas_pupuk_menurun * $hasil_probabilitas_hama_menurun;
    
    if ($posterior_meningkat > $posterior_menurun) 
    {
      $prediksi = "Meningkat";
    } else {
      $prediksi = "Menurun";
    }

    $prediksi_numerik = $this->categoryToNumeric($prediksi, $data['luas_tanam']);
  
      $saran = '';
  
      if ($prediksi == "Menurun") {
          if ($data['pupuk'] == 'Kurang') {
              $saran .= "- Tingkatkan pemberian pupuk. Pastikan dosis dan jenis pupuk sesuai dengan kebutuhan tanaman. Pertimbangkan untuk melakukan pemupukan berimbang dengan memperhatikan unsur N, P, dan K.\n";
          }
  
          if ($data['hama'] == 'Terserang') {
              $saran .= "- Lakukan pengendalian hama segera. Gunakan pestisida yang sesuai atau metode pengendalian hama terpadu. Konsultasikan dengan ahli pertanian setempat untuk penanganan optimal.\n";
          }
  
          if ($data['kondisi_lahan'] == 'Banjir' || $data['kondisi_lahan'] == 'Kering') {
              $saran .= "- Perbaiki kondisi lahan Anda. Lakukan pengolahan tanah, tambahkan pupuk organik, dan atur drainase. Pertimbangkan untuk melakukan analisis tanah untuk mengetahui kekurangan nutrisi spesifik.\n";
          }
  
          if ($data['luas_tanam'] == 'Sempit' || $data['luas_tanam'] == 'Sedang') {
              $saran .= "- Evaluasi kembali luas tanam Anda. Sesuaikan dengan kapasitas perawatan dan sumber daya yang tersedia. Pertimbangkan untuk mengoptimalkan penggunaan lahan dengan teknik penanaman yang efisien.\n";
          }
  
          if ($data['kondisi_daun'] == 'Kuning Layu') {
              $saran .= "- Atasi masalah pada daun tanaman. Periksa kemungkinan serangan penyakit atau kekurangan nutrisi. Aplikasikan fungisida jika diperlukan dan berikan pupuk daun yang sesuai.\n";
          }
  
          if (!empty($saran)) {
              $saran = "Hasil panen diprediksi menurun. Berikut saran untuk meningkatkan hasil panen:\n" . $saran;
          } else {
              $saran = "Hasil panen diprediksi menurun, namun tidak ada saran spesifik berdasarkan input Anda. Tetap pantau dan jaga kualitas perawatan tanaman Anda.";
          }
      } else {
          $saran = "Hasil panen diprediksi meningkat. Pertahankan praktik pertanian yang baik. Tetap pantau dan jaga kualitas perawatan tanaman Anda.";
      }
  
      $prediksiPanen = new hasil_prediksi();
      $prediksiPanen->user_id = $user_id;
      $prediksiPanen->nama = $nama;
      $prediksiPanen->desa_id = $desa_id;
      $prediksiPanen->luas_tanam = $luas_tanam;
      $prediksiPanen->kondisi_lahan = $kondisi_lahan;
      $prediksiPanen->kondisi_daun = $kondisi_daun;
      $prediksiPanen->pupuk = $pupuk;
      $prediksiPanen->hama = $hama;
      $prediksiPanen->saran = $saran;
      $prediksiPanen->hasil = $prediksi;
      $prediksiPanen->hasil_numerik = $prediksi_numerik;
      $prediksiPanen->save();

    return view('prediksi.aprediksi', compact('prediksi', 'prediksi_numerik', 'nama', 'desa_id', 'saran',
     'luas_tanam', 'kondisi_lahan', 'kondisi_daun', 'hama', 'pupuk', 'posterior_meningkat', 'posterior_menurun'));
  }
  public function lihatDetail(Request $request)
  {
      // Ambil data prediksi berdasarkan ID
    $prediksi = hasil_prediksi::with('desa.ppl')->where('user_id', $request->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->first();

      return view('prediksi.hasil', compact('prediksi'));
  }
}