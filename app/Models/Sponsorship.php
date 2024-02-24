<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsorship extends Model
{
    use HasFactory, SoftDeletes;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
