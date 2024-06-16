<?php

namespace App\Interfaces;

use Carbon\Carbon;


interface BookingServiceInterface
{

    public function getAvailableRentals(Carbon $checkInDate, Carbon $checkOutDate);

}