<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cv_path',
        'name',
        'phone_number',
        'email',
        'message',
        'opportunity_id'
    ];
    protected $table ='applications';
}
