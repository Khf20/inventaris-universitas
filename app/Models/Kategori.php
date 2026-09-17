<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategoris';

<<<<<<< HEAD
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

=======
>>>>>>> 5234dcea2670bad4aaf5903da628c34b5b208e9d
    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class);
    }
}
