<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public $successMessage;
    public $errorMessage;
    public $infoMessage;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->successMessage = session('success');
        $this->errorMessage = session('error');
        $this->infoMessage = session('info');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
