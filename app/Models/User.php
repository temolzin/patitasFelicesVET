<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements JWTSubject, HasMedia
{
    use Notifiable, HasRoles, InteractsWithMedia, SoftDeletes;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $primaryKey= 'id';
    protected $fillable=['name','last_name','phone','email','email_verified_at','password'];
    protected $guarded= [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vet()
    {
        return $this->hasOne(Vet::class, 'user_id');
    }

    public function adminlte_image()
    {
        if ($this->hasRole('admin')) 
        {
            return $this->admin_image ? url($this->admin_image) : url('img/avatardefault.png');
        }

        if ($this->hasRole('vet'))
        {
            return $this->vet_image ? url($this->vet_image) : url('img/vetdefault.png');
        }
    }

    public function adminlte_desc()
    {
        $role = $this->getRoleNames()->first();
        return $role ?? 'Unknown Role';

    }

    public function adminlte_profile_url()
    {
        if ($this->hasRole('Admin')) 
        {
            return route('user.profile');
        }

        if ($this->hasRole('AdminAlbergue')) 
        {
            return route('user.profile');
        }
        
        return route('user.profile');
    }

    public function hasDependencies()
    {
        return $this->vet()->exists();
    }
}
