<?php

namespace App\View\Components\Startup;

use App\Models\Area;
use Illuminate\View\Component;

class Create extends Component
{
    /**
     * As areas para cadastro.
     *
     * @var Collection $areas
     */
    public $areas;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($areas)
    {
        $this->areas = $areas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.startup.create');
    }
}
