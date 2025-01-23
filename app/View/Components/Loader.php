<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Loader extends Component
{
    public $color;
    public $size;

    /**
    * Creates a new instance of the component.
    *
    * @param string $color The color of the loader. Values ​​can be any standard Bootstrap color, such as 'primary', 'danger', 'white', etc.
    * @param string $size The size of the loader. Values ​​can be 'sm' for small, 'lg' for large, or left blank for the default size.
    */
    public function __construct($color = 'primary', $size = '')
    {
        $this->color = $color;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.loader');
    }
}
