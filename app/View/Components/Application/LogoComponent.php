<?php

namespace App\View\Components\Application;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LogoComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public int $width = 50)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.application.logo-component');
    }
}
