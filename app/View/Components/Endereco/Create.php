<?php

namespace App\View\Components\Endereco;

use Illuminate\View\Component;

class Create extends Component
{
    /**
     * Startup relacionada ao endereço.
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
        return view('components.endereco.create');
    }
}
