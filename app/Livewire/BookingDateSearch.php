<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class BookingDateSearch extends Component
{
    public $arenas;
    public $date;
    public $location_id;
    public $bookings;

    private function findBooking()
    {
        $data = Booking::with([
            'bookingFields:id,booking_id',
            'bookingFields.bookingTimes:id,schedule_pivot_id,booking_field_id'
        ])
            ->where('location_id', $this->location_id)
            ->whereDate('boking_date', $this->date)
            ->select('id',  'location_id')
            ->get()
            ->flatMap(function ($booking) {
                return $booking->bookingFields->flatMap(function ($field) {
                    return $field->bookingTimes;
                });
            })
            ->keyBy('schedule_pivot_id') // Sort here by the pivot_id;
            ->sortBy('schedule_pivot_id') // Sort here by the pivot_id
            ->unique()
            ->toArray();

        $this->bookings = $data;
    }
    public function updatedDate()
    {
        $this->validate([
            'date' => ['required', 'date', 'after_or_equal:today', 'before_or_equal:' . now()->addDays(30)->format('Y-m-d')],
        ]);
        $this->findBooking();
    }
    public function mount(string $location_id)
    {
        $this->date = now()->format('Y-m-d');
        $this->location_id = $location_id;
        $this->findBooking();
    }

    public function render()
    {
        return view('livewire.booking-date-search');
    }
}
