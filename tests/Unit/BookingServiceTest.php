<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Rental;
use App\Models\Booking;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingServiceTest extends TestCase
{
    use RefreshDatabase;
    private Rental $standaloneRental;
    private Rental $room;
    private Rental $roomType;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->standaloneRental = Rental::factory()->create(['name' => 'test standalone', 'type' => 'standalone_rental']);
        $this->room = Rental::factory()->create(['name' => 'test room', 'type' => 'room']);
        $this->roomType = Rental::factory()->create(['name' => 'test room type', 'type' => 'room_type', 'parent_rental' => $this->room->id ]);

        Booking::factory()->create([
            'rental' => $this->standaloneRental->id,
            'parent_rental' => $this->standaloneRental->id,
            'check_in_date' => Carbon::today()->addDays(1),
            'check_out_date' => Carbon::today()->addDays(5),
        ]);

        Booking::factory()->create([
            'rental' => $this->roomType->id,
            'parent_rental' => $this->room->id,
            'check_in_date' => Carbon::today()->addDays(10),
            'check_out_date' => Carbon::today()->addDays(15),
        ]);
    }

    public function testGetAvailableRentals()
    {
        $service = new BookingService();

        // Check for available rentals between valid dates
        $availableRentals = $service->getAvailableRentals(
            Carbon::today()->addDays(6),
            Carbon::today()->addDays(9)
        );

        $this->assertCount(2, $availableRentals);

        // Check for no available rentals if all are booked
        $availableRentals = $service->getAvailableRentals(
            Carbon::today()->addDays(1),
            Carbon::today()->addDays(5)
        );

        $this->assertCount(1, $availableRentals);
    }
}
