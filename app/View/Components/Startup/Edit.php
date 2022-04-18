<?php

namespace App\View\Components\Startup;

use App\Models\Startup;
use Illuminate\View\Component;

class Edit extends Component
{
    /**
     * As areas para cadastro.
     *
     * @var Collection $areas
     */
    public $areas;

    /**
     * Startup a ser editada.
     *
     * @var Startup $startup
     */
    public $startup;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($startup, $areas)
    {
        $this->startup = $startup;
        $this->areas = $areas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.startup.edit');
    }
}
