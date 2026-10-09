<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public array $headers;

    public mixed $paginator;

    public ?string $tableClass;

    public function __construct(
        array $headers = [],
        mixed $paginator = null,
        ?string $tableClass = null,
    ) {
        $this->headers = $headers;
        $this->paginator = $paginator;
        $this->tableClass = $tableClass;
    }

    public function render(): View|Closure|string
    {
        return view('components.data-table');
    }
}
