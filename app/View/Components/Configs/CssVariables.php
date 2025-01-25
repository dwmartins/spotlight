<?php

namespace App\View\Components\Configs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CssVariables extends Component
{
    public $primary;
    public $primary_hover;

    public $success;
    public $success_hover;

    public $warning;
    public $warning_hover;

    public $danger;
    public $danger_hover;

    public $link_color;
    public $link_color_hover;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->primary = config('website_colors.primary');
        $this->primary_hover = $this->darken_color(config('website_colors.primary'), 10);

        $this->success_hover = $this->darken_color(config('website_colors.success'), 10);
        $this->success = config('website_colors.success');

        $this->warning_hover = $this->darken_color(config('website_colors.warning'), 10);
        $this->warning = config('website_colors.warning');

        $this->danger_hover = $this->darken_color(config('website_colors.danger'), 10);
        $this->danger = config('website_colors.danger');

        $this->link_color_hover = $this->darken_color(config('website_colors.link_color'), 10);
        $this->link_color = config('website_colors.link_color');
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
}
