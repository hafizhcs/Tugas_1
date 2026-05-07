<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'description', 'date', 
        'location', 'price', 'stock', 'poster_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Otomatis membuat URL gambar yang benar saat dipanggil di Blade
     */
    public function getPosterUrlAttribute()
    {
        if ($this->poster_path) {
            return asset('storage/' . $this->poster_path);
        }
        // Jika tidak ada gambar, arahkan ke placeholder
        return 'https://via.placeholder.com/400x250?text=No+Image';
    }
}