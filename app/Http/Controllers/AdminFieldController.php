<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminFieldController extends Controller
{
    private $owner;

    public function __construct()
    {
        $this->owner = Auth::user()->id;
    }

    public function page(): View
    {
        $arenas = Location::with([
            'fields:id,name,number,location_id,field_type_id',
            'fields.fieldType:id,detail,price_per_hour',
        ])
            ->where('owner_id', $this->owner)
            ->select('id', 'name', 'slug', 'province', 'regency', 'distric', 'detail_address', 'gmaps', 'field_image_url')
            ->firstOrFail();
        return view('admin.field', compact('arenas'));
    }

    public function schedule(): View
    {
        $schedule = Location::with([
            'fields:id,name,number,location_id,field_type_id',
            'fields.fieldType:id,detail,price_per_hour',
            'fields.pivot:id,schedule_id,field_id',
            'fields.pivot.schedule:id,start_time,end_time',
        ])
            ->where('owner_id', $this->owner)
            ->select('id', 'name')
            ->firstOrFail();

        $data = [
            'location' => $schedule->only(['id', 'name']),
            'fields' => $schedule->fields->map(function ($field) {
                return [
                    'id' => $field->id,
                    'name' => $field->name,
                    'number' => $field->number,
                    'detail' => $field->fieldType->detail,
                    'price_per_hour' => $field->fieldType->price_per_hour,
                    'field_type_id' => $field->fieldType->id,
                    'schedules' => $field->pivot->map(function ($schedule) {
                        return [
                            'pivot_id' => $schedule->id,
                            'sch_id' => $schedule->schedule->id,
                            'start_time' => substr($schedule->schedule->start_time, 0, 5),
                            'end_time' => substr($schedule->schedule->end_time, 0, 5),
                        ];
                    })->toArray(),
                ];
            })->toArray(),
        ];
        // dd($data);
        return view('admin.schedule', ['data' => $data]);
    }
}
