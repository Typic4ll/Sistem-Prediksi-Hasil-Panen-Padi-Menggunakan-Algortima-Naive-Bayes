<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ppl;

class pplController extends Controller
{
    public function ppl(){
        $varPpl = ppl::all();
        // $varUser = User::orderBy('id','desc')->paginate(2);
        // $varUser = User::orderBy('id','desc')->get();
        // $varUser = User::latest()->get();
        return view('ppl.data_ppl', compact('varPpl'));
    }

    public function Tambahppl(){
        return view('ppl.tambah_data_ppl');
    }

    public function Simpanppl(Request $request){
        ppl::create([
            'id'=> $request->id,
            'nama'=> $request->nama,
            'j_kelamin'=> $request->j_kelamin,
            'jabatan'=> $request->jabatan,
            'golongan'=> $request->golongan,
            'telpon'=> $request->telpon
        ]);
        return redirect('data-ppl');
    }

    public function editppl($id){
        $varppl = ppl::where('id', $id)->first();
        return view('ppl.edit_data_ppl', compact('varppl'));
    }
    
    public function perubahanppl(Request $request, $id){
        $varppl = ppl::where('id', $id);
        $data = [
            'id'=> $request->id,
            'nama'=> $request->nama,
            'j_kelamin'=> $request->j_kelamin,
            'jabatan'=> $request->jabatan,
            'golongan'=> $request->golongan,
            'telpon'=> $request->telpon
        ];

        $varppl->update($data);
       return redirect('data-ppl');
    } 

    public function hapusppl($id)
    {
        $varppl = ppl::where('id' ,$id);
        $varppl->delete();
        return back();
    }
}
