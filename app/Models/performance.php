<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class performance extends Model
{
    use HasFactory;
    protected $table = 'performance';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'total_data_latih',
        'total_data_uji',
        'akurasi',
        'recall',
        'presisi'
    ];
}
