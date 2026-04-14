<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    // Menggabungkan is_archived agar fitur arsip di Admin bisa berfungsi
    protected $fillable = [
        'user_id', 
        'category_id', 
        'location', 
        'description', 
        'status', 
        'is_archived'
    ];

    /**
     * Relasi ke User (Siswa yang melapor)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Kategori (Sarana, Prasarana, dll)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke Feedback (Tanggapan dari Admin)
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'complaint_id');
    }
}