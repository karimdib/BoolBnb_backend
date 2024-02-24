<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Apartment;
use App\Models\Image;
use App\Models\Visit;
use App\Models\Order;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'date_of_birth'
    ];

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
        'password' => 'hashed',
    ];
    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    public function images()
    {
        return $this->hasManyThrough(Image::class, Apartment::class);
    }

    public function visits()
    {
        return $this->hasManyThrough(Visit::class, Apartment::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Apartment::class);
    }

    public static function booted()
    {
        User::deleting(function($user) {

            $user->visits()->delete();
            $user->images()->delete();
            $user->orders()->delete();
            $user->apartments()->delete();
            
        });
            
    }

}
