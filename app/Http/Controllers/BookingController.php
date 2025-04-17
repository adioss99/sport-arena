<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingField;
use App\Models\BookingTime;
use App\Models\Location;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    //
    private function bookAvailability($date, $locationId)
    {
        $data = Booking::with([
            'bookingFields:id,booking_id',
            'bookingFields.bookingTimes:id,schedule_pivot_id,booking_field_id'
        ])
            ->where('location_id',  $locationId)
            ->whereDate('boking_date', $date)
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

        return $data;
    }

    private function bookInputValidation($req)
    {

        $validator = Validator::make($req->all(), [
            'location_id' => 'required|exists:locations,id',
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'before_or_equal:' . now()->addDays(30)->format('Y-m-d')
            ],
            'fields' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        foreach ($req->fields as $jsonItem) {
            $item = json_decode($jsonItem, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['fields' => 'Invalid JSON format.'])->withInput();
            }

            $validator = Validator::make($item, [
                'field.fieldId' => 'required|exists:fields,id',
                'time' => 'required|array|min:1',
                'time.*.timeId' => 'required|exists:schedule_pivots,id',
            ]);

            if ($validator->fails()) {
                return $validator->errors();
            }
        }
    }

    public function booking(Request $request)
    {
        // Validate the request data
        $val = $this->bookInputValidation($request);

        if ($val) {
            Alert::error('Booking Failed', $val->first());
            return back()->withInput();
        }

        $availability = $this->bookAvailability($request->date, $request->location_id);

        $locationId = (int) $request->input('location_id');
        $date = $request->input('date');
        $totalPrice = 0;
        $totalHours = 0;

        $locationDB = Location::where('id', $locationId)->select('name', 'id', 'slug')->first();
        $slugCode = $locationDB->slug;
        $bookingCode =  strtoupper(implode('', array_map(fn($word) => $word[0], explode('-', $slugCode)))) . '' . date('ymdhis');
        if (!$locationDB) {
            Alert::error('Booking Failed', 'Location not found.');
            return back();
        }

        $fields = [];
        foreach ($request->fields as $jsonItem) {
            $item = json_decode($jsonItem, true);

            $fieldDB = Field::with('fieldType:id,price_per_hour,detail')
                ->where('id', $item['field']['fieldId'])
                ->select('id', 'name', 'field_type_id')
                ->firstOrFail();
                
            if (!$fieldDB) {
                Alert::error('Booking Failed', 'Field not found.');
                return back();
            }

            $fields[] = $fieldDB->toArray();
            $fieldPrice = $fieldDB->fieldType->price_per_hour;
            foreach ($item['time'] as $time) { 
                $boked = ( isset($availability[(int)$time['timeId']]));
                if ($boked) {
                    Alert::error('Booking Failed', 'Field already booked.');
                    return back();
                }
                $totalPrice += $fieldPrice;
                $totalHours++;
            }
        }

        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'location_id' => $locationId,
                'total_hours' => $totalHours,
                'boking_date' => $date,
                'booking_code' => $bookingCode,
                'location_name' => $locationDB->name,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'user_id' => Auth::user()->id,
            ]);
            
            $index = 0;
            foreach ($request->fields as $jsonItem) {
                $item = json_decode($jsonItem, true);
                $fieldId = (int) $item['field']['fieldId'];
                $fieldPrice = $fields[$index]['field_type']['price_per_hour'];

                $field = BookingField::create([
                    'booking_id' => $booking->id,
                    'field_name' =>  $fields[$index]['name'],
                    'field_id' => $fieldId,
                    'field_price' => $fieldPrice,
                ]);

                foreach ($item['time'] as $time) {
                    $timeId = (int) $time['timeId'];
                    BookingTime::create([
                        'booking_field_id' => $field->id,
                        'schedule_pivot_id' => $timeId,
                    ]);
                }
                $index++;
            }

            DB::commit();
            Alert::success('Booking successful!', 'Your booking has been successfully created.');
            return back()->with('dt', $date);
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Booking failed!', 'An error occurred while processing your booking. Please try again.' . $e->getMessage());
            return back();
        }
    }
    
}
