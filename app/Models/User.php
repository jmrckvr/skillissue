<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Job;

class User extends Authenticatable implements MustVerifyEmail
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
        'role',
        'profile_image',
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
     * Model casts.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'employer_id');
    }

    public function teamMemberships()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'applicant_id');
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEmployer(): bool
    {
        return $this->role === 'employer';
    }

    public function isApplicant(): bool
    {
        return $this->role === 'applicant';
    }

    public function hasApplied(Job $job): bool
    {
        return $this->applications()
            ->where('job_id', $job->id)
            ->exists();
    }

    public function hasReacted($reactable): bool
    {
        return $reactable->reactions()
            ->where('user_id', $this->id)
            ->exists();
    }
}
