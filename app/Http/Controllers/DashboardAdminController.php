<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardAdminController extends Controller
{
    public function page(): View
    { 
        return view('admin/dashboard-page');
    }
}
