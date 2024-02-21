<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'text',
        'pic',
        'video',
        'status',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
