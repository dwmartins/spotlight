<?php

namespace App\View\Components\Configs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CssVariables extends Component
{
    public $primary;
    public $success;
    public $warning;
    public $danger;
    public $link_color;
    
    /*
       customizations 
    */
    public $primary_hover;
    public $success_hover;
    public $warning_hover;
    public $danger_hover;
    public $link_color_hover;

    public $input_focus;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->primary = config('website_colors.primary');
        $this->success = config('website_colors.success');
        $this->warning = config('website_colors.warning');
        $this->danger = config('website_colors.danger');
        $this->link_color = config('website_colors.link_color');

        $this->primary_hover = $this->darken_color($this->primary, 10);
        $this->success_hover = $this->darken_color($this->success, 10);
        $this->warning_hover = $this->darken_color($this->danger, 10);
        $this->danger_hover = $this->darken_color($this->danger, 10);
        $this->link_color_hover = $this->darken_color($this->link_color, 10);

        $this->input_focus = $this->generate_box_shadow($this->primary);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.configs.css-variables');
    }

    public function darken_color($hexColor, $percent)
    {
        $hexColor = ltrim($hexColor, '#');

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        $r = max(0, min(255, $r - ($r * $percent / 100)));
        $g = max(0, min(255, $g - ($g * $percent / 100)));
        $b = max(0, min(255, $b - ($b * $percent / 100)));

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    public function generate_box_shadow($hexColor)
    {
        $darkColor = $this->darken_color($hexColor, 20);
        $rgba = $this->hex_to_rgba($darkColor, 0.788);
        return "0px 0px 3px 0px $rgba";
    }

    public function hex_to_rgba($hexColor, $alpha)
    {
        $hexColor = ltrim($hexColor, '#');

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        return "rgba($r, $g, $b, $alpha)";
    }
}
