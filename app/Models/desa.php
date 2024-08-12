<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class desa extends Model
{
    use HasFactory;
    protected $table = 'desa';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'nama_desa',
        'ppl_id'
    ];

    public function ppl(){
        return $this->belongsTo(ppl::class, "ppl_id");
    }

    public function prediksi(){
        return $this->hasMany(hasil_prediksi::class);
    }

    public function user(){
        return $this->hasMany(user::class);
    }
}
