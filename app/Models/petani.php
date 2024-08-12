<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petani extends Model
{
    use HasFactory;
    protected $table = 'petani';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'nama',
        'j_kelamin',
        'poktan'
    ];

    public function datauji(){
        return $this->hasMany(datauji::class);
    }

    public function dataset_panen(){
        return $this->hasMany(dataset_panen::class);
    }

    public function user(){
        return $this->hasMany(user::class);
    }
}
