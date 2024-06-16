<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalAvailabilityRequest;
use App\Interfaces\BookingServiceInterface;
use Carbon\Carbon;



/**
 * @OA\Info(
 *     title="Booking API",
 *     version="1.0.0"
 * )
 */
class BookingController extends Controller
{
    protected BookingServiceInterface $bookingService;

    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }


    /**
     * @OA\Get(
     *     path="/api/booking/availability",
     *     summary="Check availability of rental for bookings",
     *     @OA\Parameter(
     *         name="check_in_date",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="check_out_date",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="type", type="string"),
     *                 @OA\Property(property="parent_rental", type="integer", nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(type="object", @OA\Property(property="errors", type="object"))
     *     )
     * )
     */
    public function checkAvailability(RentalAvailabilityRequest $request)
    {
        
        $availableRentals = $this->bookingService->getAvailableRentals(
            Carbon::parse($request->check_in_date),
            Carbon::parse($request->check_out_date)
        );

        return response()->json($availableRentals);
    }

}
