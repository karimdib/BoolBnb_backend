<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Apartment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'slug',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'address',
        'latitude',
        'longitude',
        'cover_image',
        'user_id',
    ];
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
    public static function booted()
    {
        Apartment::deleting(function($apartment) {
            $apartment->images()->delete();
            $apartment->visits()->delete();
            $apartment->orders()->delete();
            $apartment->messages()->delete();

            
        });


    }
}
