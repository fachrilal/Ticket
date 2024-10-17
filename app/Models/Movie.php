<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Menambahkan kolom yang dapat diisi massal
    protected $fillable = ['title', 'genre', 'description', 'poster'];
}
