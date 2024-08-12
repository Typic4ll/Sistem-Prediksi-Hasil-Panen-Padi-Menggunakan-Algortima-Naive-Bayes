<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\petani;
use App\Models\ppl;
use App\Models\hasil_prediksi;
use Auth;
use Session;

class loginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function simpan(Request $request){
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role'=> 'user'
        ]);
        return redirect('login');
    }

    public function postLogin(Request $request){
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi'
        ]);
        if (Auth::attempt(
            [
                'email'=> $request->email,
                'password'=> $request->password,
            ]
            )){
                return redirect('/'); 
            }
        return redirect('login')->withErrors('Email dan Password Yang Anda Masukkan Tidak Valid');
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

    public function jumlah(){
        $petani = petani::count();
        $ppl = ppl::count();
        $prediksi = hasil_prediksi::count();
        $meningkat = hasil_prediksi::where('hasil', 'Meningkat')->count();
        $menurun = hasil_prediksi::where('hasil', 'Menurun')->count();
        return view('welcome', compact('petani', 'ppl', 'prediksi', 'meningkat', 'menurun'));
    }
}
