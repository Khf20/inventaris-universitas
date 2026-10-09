<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    public string $name;

    public ?string $label;

    public string $type;

    public ?string $icon;

    public ?string $placeholder;

    public bool $required;

    public int $rows;

    public mixed $value;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        ?string $label = null,
        string $type = 'text',
        ?string $icon = null,
        ?string $placeholder = null,
        bool $required = false,
        int $rows = 4,
        mixed $value = null,
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->rows = $rows;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
