<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxPermissions extends Component
{
    public $role = '';
    public $permissions = '';

    /**
     * Create a new component instance.
     */
    public function __construct($permissions, $role)
    {
        $this->permissions = $permissions;
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkbox-permissions');
    }
}
