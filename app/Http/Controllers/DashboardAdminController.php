<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardAdminController extends Controller
{
    public function page(): View
    {
        $menus = [
            ['name' => 'Dasboard', 'icon' => 'fa-chart-line', 'url' => 'admin.dashboard'],
            ['name' => 'Field', 'icon' => 'fa-futbol', 'url' => 'admin.field'],
            ['name' => 'Schedule', 'icon' => 'fa-calendar-week', 'url' => 'admin.schedule'],
        ];
        return view('admin/dashboard');
    }
}
