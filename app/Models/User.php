<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'aa_users';
    protected $primaryKey = 'aa_id';

 
    protected $fillable = [
        'aa_name',
        'aa_email',
        'aa_password',
        'aa_role',
    ];

 
    protected $hidden = [
        'aa_password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'aa_email_verified_at' => 'datetime',
            'aa_password' => 'hashed',
        ];
    }
    
    public function getAuthPassword()
    {
        return $this->aa_password;
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->aa_email;
    }
    


    public function registrations()
    {
        return $this->hasMany(Registration::class, 'aa_user_id', 'aa_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'aa_registrations', 'aa_user_id', 'aa_event_id');
    }
}
