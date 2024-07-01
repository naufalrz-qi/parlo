<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;

    public $incrementing = false; // Non-incrementing or non-numeric primary key

    protected static function boot()
    {
        parent::boot();

        // Set ID saat model sedang dibuat
        static::creating(function ($model) {
            $model->id = 'b-' . now()->format('dmyHis');
        });
    }

    protected $guarded = [];
    public function user(): BelongsTo

    {

        return $this->belongsTo(User::class);

    }


    public function destination(): BelongsTo

    {

        return $this->belongsTo(Destinations::class);

    }
    public function facilities(): BelongsToMany

    {

        return $this->belongsToMany(Facility::class, 'booking_facility', 'booking_id', 'facility_id');

    }
}
