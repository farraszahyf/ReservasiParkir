<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parkir extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'plat',
        'product_code',
        'nama_motor'
    ];
    use HasFactory;
}
