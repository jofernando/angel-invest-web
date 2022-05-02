<?php

namespace App\View\Components\Telefone;

use Illuminate\View\Component;

class Edit extends Component
{
    /**
     * Telefones relacionados a startup.
     *
     * @var Collection $telefones
     */
    public $telefones;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($startup, $telefones)
    {
        $this->startup = $startup;
        $this->telefones = $telefones;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.telefone.edit');
    }
}
