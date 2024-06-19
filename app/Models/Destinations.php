<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinations extends Model
{
    use HasFactory;
    protected $table = 'destinations';
    protected $guarded = [];

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'destination_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getTotalPrice(array $facilityIds)
    {
        $facilityPrices = Facility::whereIn('id', $facilityIds)->sum('price');
        return $this->price + $facilityPrices;
    }

}
