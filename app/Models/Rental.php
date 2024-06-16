<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'parent_rental'];

    protected $hidden = ['created_at', 'updated_at'];

    const TABLE_NAME = 'rentals';
    
    const NAME = 'name';
    const TYPE = 'type';
    const PARENT_RENTAL = 'parent_rental';

    const RENTABLE_TYPES = ['standalone_rental', 'room_type'] ;

    public function parent()
    {
        return $this->belongsTo(Rental::class, 'parent_rental');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'rental');
    }

}
