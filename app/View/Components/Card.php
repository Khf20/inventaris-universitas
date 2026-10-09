<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public ?string $header;

    public ?string $icon;

    public ?string $iconBg;

    public ?string $iconColor;

    public ?string $action;

    public ?string $bodyClass;

    /**
     * Create a new component instance.
     */
    public function __construct(
        ?string $header = null,
        ?string $icon = null,
        ?string $iconBg = null,
        ?string $iconColor = null,
        ?string $action = null,
        ?string $bodyClass = null,
    ) {
        $this->header = $header;
        $this->icon = $icon;
        $this->iconBg = $iconBg;
        $this->iconColor = $iconColor;
        $this->action = $action;
        $this->bodyClass = $bodyClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
