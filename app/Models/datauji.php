<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datauji extends Model
{
    use HasFactory;
    protected $table = 'datauji';
    protected $primarykey = 'id';
    protected $fillable = [
        'nik_petani',
        'luas_tanam',
        'kondisi_lahan',
        'kondisi_daun',
        'pupuk',
        'hama',
        'hasil'
    ];


    public function petani(){
        return $this->belongsTo(petani::class, "nik_petani");
    }
}
