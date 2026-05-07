<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    // Relasi: 1 Category memiliki banyak Event
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}