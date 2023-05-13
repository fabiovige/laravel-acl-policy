<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListPermissions extends Component
{
    public $route = '';
    public $rows = '';

    /**
     * Create a new component instance.
     */
    public function __construct($rows, $route)
    {
        $this->rows = $rows;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
