<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $id;
    public $name;
    public $maxChars;
    public $placeholder;
    public $rows;
    public $value;
    public $class;

    /**
     * Create a new component instance.
     */
    public function __construct($id = null, $name, $maxChars = 500, $placeholder = null, $rows = 7, $value = null, $class = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->maxChars = $maxChars;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->value = $value;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}
