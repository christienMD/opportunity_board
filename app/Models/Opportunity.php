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
   protected $table = 'opportunities';

    // In Opportunity model
    public function company()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // search filter
    public function scopeSearchFilter($query, $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title','like', '%' . request('search') . '%');
            $query->orWhere('description','like', '%' . request('search') . '%');
              
        }
    }

    // home search filter
    public function scopeHomeSearchFilter($query, $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title','like', '%' . request('search') . '%');
            $query->orWhere('description','like', '%' . request('search') . '%');
              
        }
    }


}
