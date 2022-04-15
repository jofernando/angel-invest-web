<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create startup') }}
        </h2>
    </x-slot>
    @if(session('message'))
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
        </svg>
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                {{session('message')}}
            </div>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <a href="{{route('startups.create')}}">criar</a>
            </div>
            @foreach ($startups as $startup)
                <p>{{ $startup->nome }} <a href=" {{route('startups.edit', $startup)}} ">editar</a> <a href=" {{route('startups.destroy', $startup)}} ">deletar</a></p>
                <a href="{{route('documentos.create', $startup)}}">criar</a>
            @endforeach
        </div>
    </div>
    <script>
        CKEDITOR.replace('descricao');
        $("#cnpj").mask("99.999.999/9999-99");
    </script>
</x-app-layout>
