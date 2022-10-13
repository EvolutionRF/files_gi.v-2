<?php

namespace App\View\Components;

use Illuminate\View\Component;

class breadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $parents;
    public function __construct($parents)
    {
        $this->parents = $parents;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
