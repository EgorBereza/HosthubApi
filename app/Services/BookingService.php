<?php
namespace App\Services;

use App\Interfaces\BookingServiceInterface;
use App\Models\Booking;
use App\Models\Rental;
use Carbon\Carbon;


class BookingService implements BookingServiceInterface
{
    public function getAvailableRentals(Carbon $checkInDate, Carbon $checkOutDate)
    {
        $availableRentals = Rental::whereIn(Rental::TYPE, Rental::RENTABLE_TYPES)
        ->whereDoesntHave(Booking::TABLE_NAME, function ($query) use ($checkInDate, $checkOutDate) {
                $query->where(function ($query) use ($checkInDate, $checkOutDate) {
                    $query->where(Booking::CHECK_IN_DATE,  '<=', $checkOutDate)
                          ->where(Booking::CHECK_OUT_DATE, '>=', $checkInDate);
                })
                ->orWhereBetween(Booking::CHECK_IN_DATE, [$checkInDate, $checkOutDate])
                ->orWhereBetween(Booking::CHECK_OUT_DATE, [$checkInDate, $checkOutDate]);
        })
        ->get();

        return $availableRentals;
    }
}

