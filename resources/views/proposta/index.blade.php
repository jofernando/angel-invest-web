<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <a href="{{route('propostas.create', $startup)}}">criar</a>
            </div>
            @foreach ($propostas as $proposta)
                <p><a href="{{route('propostas.show', ['startup' => $startup, 'proposta' => $proposta])}}">{{$proposta->titulo}}</a> <a href=" {{route('propostas.edit',  ['startup' => $startup, 'proposta' => $proposta])}} ">editar</a>
                    <form method="POST" action="{{route('propostas.destroy',  ['startup' => $startup, 'proposta' => $proposta])}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">deletar</button>
                    </form>
                </p>
            @endforeach
        </div>
    </div>
</x-app-layout>