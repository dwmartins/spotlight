<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnDanger extends Component
{
    public $id;
    public $text;
    public $text_loading;
    public $size;
    public $type;
    public $useLoader;
    public $onclick;

    /**
     * Create a new component instance.
     */
    public function __construct($text = "", $text_loading = null, $useLoader = true, $id = null, $size = null, $type = 'button', $onclick = null)
    {
        $this->id = $id;
        $this->text = $text ? $text : trans('messages.btn_text_save');
        $this->text_loading = $text_loading ? $text_loading : trans('messages.btn_label_loading');
        $this->size = $size;
        $this->type = $type;
        $this->onclick = $onclick;
        $this->useLoader = $useLoader;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.btn-danger');
    }
}
