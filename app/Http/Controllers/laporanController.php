<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hasil_prediksi;
use App\Models\desa;
use App\Models\ppl;
use App\Models\performance;
use App\Models\dataset_panen;
use App\Models\petani;


class laporanController extends Controller
{
    public function laporan(request $request){
        $search = $request->query('search');
        if(!empty($search)){
            $laporan = hasil_prediksi::with('desa.ppl')->Where('hasil_prediksi.nama','like','%'.$search.'%')
            ->paginate(15);
        }else{
        $laporan = hasil_prediksi::latest('id')->paginate(15);
        }
        return view('laporan.laporan_prediksi', compact('laporan'));
    }

    public function Hapuslaporan($id)
    {
        $varlaporan = hasil_prediksi::where('id' ,$id);
        $varlaporan->delete();
        return back();
    }

    public function Cetaklaporan(){
        $desa = desa::all();
        return view('laporan.cetak_laporan', compact('desa'));
    }

    public function Cetak($tanggal_awal, $tanggal_akhir, $nama_petani = null, $desa_id = null)
{
    $query = hasil_prediksi::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir]);

    // Jika nama_petani ada dan bukan '-', gunakan filter nama
    if ($nama_petani && $nama_petani !== '-') {
        $query->where('nama', 'like', '%' . $nama_petani . '%');
    }

    // Jika desa_id ada dan bukan string kosong, gunakan filter desa
    if ($desa_id && $desa_id !== '') {
        $query->where('desa_id', $desa_id);
    }

    $cetak = $query->orderBy('created_at')->get();
    $jumlah = hasil_prediksi::count();

    $akurasi = performance::latest()->first();

    $desa = $desa_id && $desa_id !== '' ? Desa::find($desa_id) : null;
    $nama_desa = $desa ? $desa->nama_desa : 'Semua Desa';

    return view('laporan.cetak', compact('cetak', 'jumlah', 'akurasi', 'tanggal_awal', 'tanggal_akhir', 'nama_petani', 'nama_desa'));
}

    public function chart(){
        $chart = hasil_prediksi::count();
        $meningkat = hasil_prediksi::where('hasil', 'Meningkat')->count();
        $menurun = hasil_prediksi::where('hasil', 'Menurun')->count();
        return view('laporan.chart', compact('chart', 'meningkat', 'menurun'));
    }

    public function Laporanpanen(){
        $panen = dataset_panen::with('petani')->orderBy('id','desc')->paginate(10);
        return view('laporan.panen', compact('panen'));
    }

    public function Cetakpanen(){
        $panen = dataset_panen::with('petani')->orderBy('id','desc')->get();
        return view('laporan.Cpanen', compact('panen'));
    }
}
