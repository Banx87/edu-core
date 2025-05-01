<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputToggleBlock extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $name, public $label = "", public $description = "", public $checked = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-toggle-block');
    }
}
