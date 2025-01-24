<?php

namespace App\View\Components\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BtnPrimaryOutline extends Component
{
    public $id;
    public $text;
    public $text_loading;
    public $size;
    public $useLoader;
    public $onclick;

    /**
     * Create a new component instance.
     */
    public function __construct($text = "", $text_loading = null, $useLoader = true, $id = null, $size = null, $onclick = null)
    {
        $this->id = $id;
        $this->text = $text ? $text : trans('messages.BTN_TEXT_SAVE');
        $this->text_loading = $text_loading ? $text_loading : trans('messages.BTN_LABEL_LOADING');
        $this->size = $size;
        $this->onclick = $onclick;
        $this->useLoader = $useLoader;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.btn-primary-outline');
    }
}
