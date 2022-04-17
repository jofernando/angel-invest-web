<?php

namespace App\View\Components\Documentos;

use Illuminate\View\Component;

class Create extends Component
{
    /**
     * Startup relacionada ao documentos.
     *
     * @var Startup $startup
     */
    public $startup;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($startup)
    {
        $this->startup = $startup;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.documentos.create');
    }
}
