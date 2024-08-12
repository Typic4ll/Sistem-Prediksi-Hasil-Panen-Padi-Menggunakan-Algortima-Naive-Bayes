<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\petani;

class petaniController extends Controller
{
    public function petani(request $request){
        $search = $request->query('search');
        if(!empty($search)){
            $varpetani = petani::where('petani.id','like','%'.$search.'%')
            ->orWhere('petani.nama','like','%'.$search.'%')
            ->orWhere('petani.poktan','like','%'.$search.'%')
            ->paginate(10);
        }else{
        $varpetani = petani::latest()->paginate(15);
        }
        return view('petani.data_petani', compact('varpetani'));
    }

    public function Tambahpetani(){
        return view('petani.tambah_data_petani');
    }

    public function Simpanpetani(Request $request){
        petani::create([
            'id'=> $request->id,
            'nama'=> $request->nama,
            'j_kelamin'=> $request->j_kelamin,
            'poktan'=> $request->poktan
        ]);
        return redirect('data-petani');
    }

    public function Editpetani($id){
        $varpetani = petani::where('id', $id)->first();
        return view('petani.edit_data_petani', compact('varpetani'));
    }
    
    public function Perubahanpetani(Request $request, $id){
        $varpetani = petani::where('id', $id);
        $data = [
            'id'=> $request->id,
            'nama'=> $request->nama,
            'j_kelamin'=> $request->j_kelamin,
            'poktan'=> $request->poktan
        ];

        $varpetani->update($data);
       return redirect('data-petani');
    } 

    public function Hapuspetani($id)
    {
        $varpetani = petani::where('id' ,$id);
        $varpetani->delete();
        return back();
    }
}
