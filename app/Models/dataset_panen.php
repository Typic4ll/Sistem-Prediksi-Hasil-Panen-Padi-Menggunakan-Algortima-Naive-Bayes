<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataset_panen extends Model
{
    use HasFactory;
    protected $table = 'dataset_panen';
    protected $primarykey = 'id';
    protected $fillable = [
        'nik_petani',
        'luas_tanam',
        'kondisi_lahan',
        'kondisi_daun',
        'pupuk',
        'hama',
        'hasil',
        'hektar',
        'kg',
        'ton',
    ];

    public function petani(){
        return $this->belongsTo(petani::class, "nik_petani");
    }
}
