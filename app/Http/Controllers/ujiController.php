<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\datauji;
use App\Models\petani;

class ujiController extends Controller
{
    public function uji(){
        $varuji = datauji::with('petani')->latest()->get();
        return view('data_uji.data_uji', compact('varuji'));
    }

    public function Tambahuji(){
        $show1 = petani::orderBy('nama', 'asc')->get();
        return view('data_uji.tambah_data_uji', compact('show1'));
    }

    public function Simpanuji(Request $request){
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
        datauji::create([
            'nik_petani'=> $request->nik_petani,
            'luas_tanam' => $luas_tanam_kategori,
            'kondisi_lahan' => $request->kondisi_lahan,
            'kondisi_daun' => $request->kondisi_daun,
            'pupuk' => $pupuk_kategori,
            'hama' => $request->hama,
            'hasil' => $hasil_kategori
        ]);
    
        return redirect('data-uji');
    }

    public function Edituji($id){
        $varuji = datauji::where('id', $id)->first();
        $petani = petani::orderBy('nama', 'asc')->get();
        return view('data_uji.edit_data_uji', compact('varuji', 'petani'));
    }
    
    public function Perubahanuji(Request $request, $id){
        $varuji = datauji::where('id', $id);
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
            'hasil' => $hasil_kategori
        ];

        $varuji->update($data);
       return redirect('data-uji');
    } 

    public function Hapusuji($id)
    {
        $varuji = datauji::where('id' ,$id);
        $varuji->delete();
        return back();
    }
}
