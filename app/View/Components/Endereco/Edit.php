<?php

namespace App\View\Components\Endereco;

use Illuminate\View\Component;

class Edit extends Component
{
    /**
     * Startup relacionada ao endereço.
     *
     * @var Startup $startup
     */
    public $startup;

    /**
     * Endereço a ser editado.
     *
     * @var Endereco $endereco
     */
    public $endereco;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($startup, $endereco)
    {
        $this->startup = $startup;
        $this->endereco = $endereco;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.endereco.edit');
    }
}
