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
        'student_number',
        'class',
        'opleiding',
        'role',
        'microsoft_id',
        'avatar',
    ];

    public function keuzedelen()
    {
        return $this->belongsToMany(Keuzedeel::class, 'keuzedeel_user')
            ->withPivot('status', 'eerder_gedaan', 'eerder_markering')
            ->withTimestamps();
    }

    public function eerderKeuzedelen()
    {
        return $this->keuzedelen()
            ->wherePivot('eerder_gedaan', true)
            ->get();
    }

    public function heeftEerderKeuzedeel($keuzedeelId)
    {
        return $this->keuzedelen()
            ->where('keuzedeel_id', $keuzedeelId)
            ->wherePivot('eerder_gedaan', true)
            ->exists();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->hasMany(Notification::class)->where('is_read', false);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSlb()
    {
        return $this->role === 'slb';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

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
}
