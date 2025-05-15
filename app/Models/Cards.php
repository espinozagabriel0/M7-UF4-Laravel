<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;
    protected $table = 'cards';
    protected $fillable = ['name', 'url'];

    // Relación 1-1
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
