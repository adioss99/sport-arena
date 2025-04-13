<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class breadcrumbs extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $segments = [];
        $path = request()->path(); // Get current path

        $url = url('/'); // Start from base URL
        $parts = explode('/', $path); // Split the path into parts

        foreach ($parts as $part) {
            $url .= '/' . $part;
            $segments[$url] = ucfirst(str_replace('-', ' ', $part)); // Format breadcrumb name
        }

        // dd($segments);
        return view('components.breadcrumbs', compact('segments'));
    }
}
