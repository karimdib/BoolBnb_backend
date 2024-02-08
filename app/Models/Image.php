<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'link',
        'apartment_id'
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
