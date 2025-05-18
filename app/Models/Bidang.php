<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang'; // Nama tabel di database
    protected $fillable = ['nama_bidang']; // Kolom yang bisa diisi (mass assignable)

    // Relasi ke model Staf (One to Many)
    public function staf()
    {
        return $this->hasMany(Staf::class, 'bidang_id');
    }
}
