<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxAccess extends Component
{
    public $rows = '';
    public $contains = '';
    public $name = '';

    /**
     * Create a new component instance.
     */
    public function __construct($rows, $contains, $name)
    {
        $this->rows = $rows;
        $this->contains = $contains;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkbox-access');
    }
}
