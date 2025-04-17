<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldType;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AdminFieldController extends Controller
{
    private $owner;
    private $locationId;

    public function __construct()
    {
        $this->owner = Auth::user()->id;
        $this->locationId = Auth::user()->location->id;
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

        $arenas->fields = $arenas->fields->sortBy('number');

        $fieldType = FieldType::where('location_id', $arenas->id)->get();

        return view('admin.field', compact('arenas'), compact('fieldType'));
    }

    public function locationUpdate(Request $request)
    {
        $val = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'regency' => 'required|string|max:255',
            'distric' => 'required|string|max:255',
            'detail_address' => 'required|string|max:255',
            'gmaps' => 'required|string|max:255',
        ]);

        if ($val->fails()) {
            Alert::error('Error', 'Failed to update location' . $val->messages()->all()[0]);
            return back();
        }
        
        $data = Location::findOrFail($this->locationId);
        $data->update($request->all());
        
        Alert::success('Success', 'Location updated successfully');
        return back();
    }

    public function create(Request $request)
    {
        $val = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|numeric',
            'field_type_id' => 'required|exists:field_types,id',
        ]);

        if ($val->fails()) {
            Alert::error('Error', 'Failed to update field type ' . $val->messages()->all()[0]);
            return back();
        }

        $data = Field::create([
            'location_id' => $this->locationId,
            'name' => $request->name,
            'number' => $request->number,
            'field_type_id' => $request->field_type_id
        ]);

        Alert::success('Success', 'Field created successfully');
        return back();
    }

    public function update(Request $request, int $id)
    {
        $credentials = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|numeric',
            'field_type_id' => 'required|exists:field_types,id',
        ]);

        if ($credentials->fails()) {
            Alert::error('Error', 'Failed to update field type' . $credentials->messages()->all()[0]);
            return back();
        }

        $data = Field::where('id', $id)->where('location_id', $this->locationId)->first();
        if (!$data) {
            Alert::error('Error', 'Field not found');
            return back();
        }

        $data->update($request->all());
        Alert::success('Success', 'Field updated successfully');
        return back();
    }

    public function delete(int $id)
    {
        $data = Field::where('id', $id)->where('location_id', $this->locationId)->first();
        if (!$data) {
            Alert::error('Error', 'Field not found');
            return back();
        }

        $data->delete();
        Alert::success('Success', $data->name . ' deleted successfully');
        return back();
    }

    public function typeCreate(Request $request)
    {
        $val = Validator::make($request->all(), [
            'detail' => 'required|string|max:255',
            'price_per_hour' => 'required|integer',
        ]);

        if ($val->fails()) {
            Alert::error('Error', 'Failed to update field type' . $val->messages()->all()[0]);
            return back();
        }

        $data = FieldType::create([
            'detail' => $request->detail,
            'price_per_hour' => $request->price_per_hour,
            'location_id' => $this->locationId
        ]);
        Alert::success('Success', 'Field type created successfully');
        return back();
    }

    // 
    public function updateFieldType(Request $request, int $id)
    {
        $val = Validator::make($request->all(), [
            'detail' => 'required|string|max:255',
            'price_per_hour' => 'required|integer',
        ]);

        if ($val->fails()) {
            Alert::error('Error', 'Failed to update field type' . $val->messages()->all()[0]);
            return back();
        }

        $data = FieldType::where('id', $id)->where('location_id', $this->locationId)->first();;
        if (!$data) {
            Alert::error('Error', 'Failed to update field type');
            return back();
        }

        $data->update($request->all());

        Alert::success('Success', 'Field type updated successfully');
        return back();
    }

    public function deleteFieldType(int $id)
    {
        $field = Field::where('field_type_id', $id)->where('location_id', $this->locationId)->first();
        if ($field) {
            Alert::error('Error', 'Field type is in use');
            return back();
        }

        $data = FieldType::where('id', $id)->where('location_id', $this->locationId)->first();
        if (!$data) {
            Alert::error('Error', 'Field type not found');
            return back();
        }

        $data->delete();
        Alert::success('Success', $data->detail . ' deleted successfully');
        return back();
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
