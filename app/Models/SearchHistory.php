<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'query',
        'results',
        'ip_address'
    ];

    protected $casts = [
        'results' => 'array'
    ];

    /**
     * Get the user that owns the search history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}