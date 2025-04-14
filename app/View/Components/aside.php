<?php

namespace App\View\Components;

use Closure;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\View\Component;

class aside extends Component
{
    /**
     * Create a new component instance.
     */
    private $menus;

    public function __construct()
    {
        $menusByRole = [
            'superadmin' => [
                ['name' => 'Super', 'icon' => 'fa-chart-line', 'url' => 'super.dashboard'],
            ],
            'admin' => [
                ['name' => 'Dasboard', 'icon' => 'fa-chart-line', 'url' => 'admin.dashboard'],
                ['name' => 'Field', 'icon' => 'fa-futbol', 'url' => 'admin.field'],
                ['name' => 'Field Schedule', 'icon' => 'fa-calendar-week', 'url' => 'admin.schedule'],
            ],
            'user' => [
                ['name' => 'User', 'icon' => 'fa-chart-line', 'url' => 'dashboard'],
            ],
        ];
        
        $this->menus = $menusByRole[FacadesAuth::user()->role->name] ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.aside', ['menus' => $this->menus]);
    }
}
