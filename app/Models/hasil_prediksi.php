<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_prediksi extends Model
{
    use HasFactory;
    protected $table = 'hasil_prediksi';
    protected $primarykey = 'id';
    protected $fillable = [
        'user_id',
        'nama',
        'desa_id',
        'luas_tanam',
        'kondisi_lahan',
        'kondisi_daun',
        'pupuk',
        'hama',
        'saran',
        'hasil',
        'hasil_numerik'
    ];

     public function desa(){
         return $this->belongsTo(desa::class, "desa_id");
    }
}
