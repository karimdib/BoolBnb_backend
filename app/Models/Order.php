<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function sponsorship()
    {
        return $this->belongsTo(Sponsorship::class);
    }
}
