<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminBookingController extends Controller
{
    private $locationId;

    public function __construct()
    {
        $owner = Auth::user()->location->id;
        $this->locationId = $owner;
    }

    public function page($status = null)
    {
        if ($status && !in_array($status, ['pending', 'success', 'cancel', 'expired'])) {
            abort(404); // Extra safety (optional)
        }
        return view('admin.booking');
    }
}
