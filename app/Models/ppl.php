<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ppl extends Model
{
    use HasFactory;
    protected $table = 'ppl';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'nama',
        'j_kelamin',
        'jabatan',
        'golongan',
        'telpon'
    ];

    public function desa(){
         return $this->hasMany(desa::class);
    }
}
