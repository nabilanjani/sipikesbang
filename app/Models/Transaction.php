<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions'; // Pastikan nama tabel benar

    protected $fillable = [
        'item_id',
        'category_id',
        'staff_id',
        'bidang_id',
        'quantity',
        'email',
        'otp',
        'submission_date',
        'description',
        'status'
    ];

    /**
     * Relasi ke model Item.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Relasi ke model Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke model Staf.
     */
    public function staff()
    {
        return $this->belongsTo(Staf::class);
    }

    /**
     * Relasi ke model Bidang.
     */
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
}