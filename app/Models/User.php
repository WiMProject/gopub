<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'bio',
        'institution',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the publications for the user.
     */
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    /**
     * Get the search histories for the user.
     */
    public function searchHistories()
    {
        return $this->hasMany(SearchHistory::class);
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole(string $roleName): bool
    {
        // Eager load role if not already loaded
        if (!$this->relationLoaded('role')) {
            $this->load('role');
        }
        
        // Debug untuk melihat role user
        \Log::debug('User role check: ' . ($this->role ? $this->role->name : 'no role') . ' === ' . $roleName);
        
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is a publisher.
     */
    public function isPublisher(): bool
    {
        return $this->hasRole('publisher');
    }
}