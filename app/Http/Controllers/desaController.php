<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\desa;
use App\Models\ppl;

class desaController extends Controller
{
    public function desa(){
        $vardesa = desa::with('ppl')->latest()->get();
        return view('desa.data_desa', compact('vardesa'));
    }

    public function Tambahdesa(){
        $show1 = ppl::all();
        return view('desa.tambah_data_desa', compact('show1'));
    }

    public function Simpandesa(Request $request){
        desa::create([
            'id'=> $request->id,
            'nama_desa'=> $request->nama_desa,
            'ppl_id'=> $request->ppl_id
        ]);
        return redirect('data-desa');
    }

    public function editdesa($id){
        $vardesa = desa::where('id', $id)->first();
        $ppl = ppl::all();
        return view('desa.edit_data_desa', compact('vardesa', 'ppl'));
    }
    
    public function perubahandesa(Request $request, $id){
        $vardesa = desa::where('id', $id);
        $data = [
            'id'=> $request->id,
            'nama_desa'=> $request->nama_desa,
            'ppl_id'=> $request->ppl_id
        ];

        $vardesa->update($data);
       return redirect('data-desa');
    } 

    public function hapusdesa($id)
    {
        $vardesa = desa::where('id' ,$id);
        $vardesa->delete();
        return back();
    }
}
