<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Rental;
use App\Models\Booking;
use Carbon\Carbon;

class BookingControllerTest extends TestCase
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

    public function testAvailableRentalsForGivenDates()
    {
        $response = $this->json('GET', '/api/booking/availability', [
            'check_in_date' => Carbon::today()->addDays(6)->toDateString(),
            'check_out_date' => Carbon::today()->addDays(9)->toDateString(),
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    public function testNoAvailableRentalsIfAllAreBooked()
    {
        $response = $this->json('GET', '/api/booking/availability', [
            'check_in_date' => Carbon::today()->addDays(1)->toDateString(),
            'check_out_date' => Carbon::today()->addDays(15)->toDateString(),
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function testValidationErrorForInvalidDateFormat()
    {
        $response = $this->json('GET', '/api/booking/availability', [
            'check_in_date' => '06-10-2024',
            'check_out_date' => '06-15-2024',
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure(['errors']);
    }

    public function testValidationErrorForCheckoutBeforeCheckin()
    {
        $response = $this->json('GET', '/api/booking/availability', [
            'check_in_date' => Carbon::today()->addDays(10)->toDateString(),
            'check_out_date' => Carbon::today()->addDays(5)->toDateString(),
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure(['errors']);
    }
}
