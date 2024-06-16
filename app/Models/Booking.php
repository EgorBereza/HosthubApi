<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['parent_rental', 'rental', 'check_in_date', 'check_out_date'];

    protected $hidden = ['created_at', 'updated_at'];

    const TABLE_NAME = 'bookings';

    const PARENT_RENTAL = 'parent_rental';
    const RENTAL = 'rental';
    const CHECK_IN_DATE = 'check_in_date';
    const CHECK_OUT_DATE = 'check_out_date';

    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental');
    }

    public function parentRental()
    {
        return $this->belongsTo(Rental::class, 'parent_rental');
    }
    
}
