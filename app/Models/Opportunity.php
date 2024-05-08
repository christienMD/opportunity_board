<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'img_url', 'category', 'status', 'closing_date', 'user_id','published_at'];
    protected $casts = [
        'closing_date' => 'datetime',
        'published_at' => 'datetime'
    ];
}
