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
        return $this->hasMany(Facility::class);
    }

}
