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
        'lastName',
        'email',
        'description',
        'phone',
        'dateOfBirth',
        'address',
        'complement',
        'city',
        'zipCode',
        'state',
        'country',
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
     * @return Boolean Returns true or false if the user has access to the App/Dashboard
     */
    public function hasAppAccess() 
    {
        return in_array($this->role, config('constants.has_access_app'));
    }

    public function updateLastLogin()
    {
        $this->timestamps = false;
        $this->last_login_at = now();
        $this->save();
        $this->timestamps = true;
    }

    public function getAvatar()
    {
        return $this->avatar ?
            config('constants.path_to_user_avatars') . $this->avatar . "?v=" . $this->updated_at->timestamp :
            config('constants.path_to_default_avatar');
    }

    public function getFullName()
    {
        return $this->lastName ? $this->name .' '. $this->lastName : $this->name;
    }
}
