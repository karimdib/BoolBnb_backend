<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'street_name',
        'street_number',
        'city',
        'postal_code',
        'latitude',
        'longitude',
        'cover_image'
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
}
