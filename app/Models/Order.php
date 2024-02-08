<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function sponsorship()
    {
        return $this->belongsTo(Sponsorship::class);
    }
}
