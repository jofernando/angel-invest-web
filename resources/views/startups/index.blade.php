<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create startup') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <a href="{{route('startups.create')}}">criar</a>
            </div>
            @foreach ($startups as $startup)
                <p>{{$startup->nome}} <a href=" {{route('startups.edit', $startup)}} ">editar</a> <a href=" {{route('startups.destroy', $startup)}} ">deletar</a></p>
                <p><a href="{{route('propostas.index', $startup)}}">propostas</a></p>
            @endforeach
        </div>
    </div>
    <script>
        CKEDITOR.replace('descricao');
        $("#cnpj").mask("99.999.999/9999-99");
    </script>
</x-app-layout>
