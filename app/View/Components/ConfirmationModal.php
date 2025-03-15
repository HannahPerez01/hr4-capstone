<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    public $action;
    public $title;
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($action, $title = 'Confirm Action', $id = null)
    {
        $this->action = $action;
        $this->title  = $title;
        $this->id     = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.confirmation-modal');
    }
}
