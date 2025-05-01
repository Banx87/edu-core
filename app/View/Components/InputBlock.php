<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputBlock extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $name, public $label = '', public $placeholder = '', public $value = '', public $required = false, public $disabled = false, public $readonly = false, public $autocomplete = 'off', public $class = '', public $id = '', public $error = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->autocomplete = $autocomplete;
        $this->class = $class;
        $this->id = $id;
        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-block');
    }
}
