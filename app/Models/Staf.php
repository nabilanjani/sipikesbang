<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staf extends Model
{
    use HasFactory;

    protected $table = 'staf'; // Nama tabel di database
    protected $fillable = ['nama', 'nip', 'bidang_id']; // Kolom yang bisa diisi (mass assignable)

    // Relasi ke model Bidang (Many to One)
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
