<?php

namespace App\View\Components\Documentos;

use Illuminate\View\Component;

class Edit extends Component
{
    /**
     * Startup relacionada ao documentos.
     *
     * @var Startup $startup
     */
    public $startup;

    /**
     * Documentos relacionados a startup.
     *
     * @var Collection $documentos
     */
    public $documentos;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($startup, $documentos)
    {
        $this->startup = $startup;
        $this->documentos = $documentos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.documentos.edit');
    }
}
