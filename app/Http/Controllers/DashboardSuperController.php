<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardSuperController extends Controller
{
    public function page(): View
    {
        return view('super/dashboard');
    }
}
