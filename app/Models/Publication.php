<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'abstract',
        'content',
        'authors',
        'keywords',
        'publication_type',
        'file_path',
        'views',
        'downloads',
        'status'
    ];
    
    protected $attributes = [
        'views' => 0,
        'downloads' => 0,
        'status' => 'draft'
    ];

    /**
     * Get the user that owns the publication.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to search publications.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('abstract', 'like', "%{$searchTerm}%")
                ->orWhere('content', 'like', "%{$searchTerm}%")
                ->orWhere('authors', 'like', "%{$searchTerm}%")
                ->orWhere('keywords', 'like', "%{$searchTerm}%");
        });
    }
}