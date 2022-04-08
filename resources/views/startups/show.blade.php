<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show startup') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p>{{$startup->nome}}</p>
            <p>{{$startup->email}}</p>
            <p>{{$startup->cnpj}}</p>
            <div>{!!$startup->descricao!!}</div>
            <img src="{{'/storage/'.$startup->logo}}" alt="logo">
            <p>{{$startup->area->nome}}</p>
        </div>
    </div>
</x-app-layout>
