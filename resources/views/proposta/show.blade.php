<x-app-layout>
    <div class="container-fluid" style="margin-bottom: -70px;">
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
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:window.history.back();" class="btn btn-success btn-padding border" style="margin-left: 15px;"><img src="{{asset('img/back.svg')}}" alt="Icone de voltar" style="height: 22px;"> Voltar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <video id="video-proposta" controls poster="{{asset('storage/'.$proposta->thumbnail_caminho)}}" style="width: 100%; height: 350px;">
                    <source src="{{asset('storage/'.$proposta->video_caminho)}}" type="video/mp4">
                    <source src="{{asset('storage/'.$proposta->video_caminho)}}" type="video/mkv">
                </video>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>{{$proposta->titulo}}</h3>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <span id="span-area-proposta-startup">{{$startup->area->nome}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-0 px-0">
                        <div class="flex flex-wrap">
                            <div @class([
                                    'py-3 pl-3 w-full',
                                    'md:w-3/4' => $proposta->leilao_atual(),
                                ])>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h4 class="card-title">{{$proposta->startup->nome}}</h4>
                                        <div class="card-text mr-3">
                                            {!! $proposta->descricao !!}
                                        </div>
                                    </div>
                                </div>
                                @can('update', $startup)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            @if(is_null($proposta->leilao_atual()))
                                                <a href="{{route('leilao.create')}}?produto={{$proposta->id}}" class="btn btn-success btn-default btn-padding border"><img src="{{asset('img/dolar-bag.svg')}}" alt="Ícone de criar" style="width: 40px;"><span style="font-weight: bolder;">Criar leilão</span></a>
                                            @endif
                                        </div>
                                    </div>
                                @endcan
                                <div class="row mb-4">
                                    @if ($leilao = $proposta->leilao_atual())
                                        <div>
                                            <span class="text-proposta"><img class="icon" src="{{asset('img/calendar.svg')}}" alt="Ícone de calendario"> Lances durante: <b>{{date('d/m', strtotime($leilao->data_inicio))}} a {{date('d/m', strtotime($leilao->data_fim))}}</b></span>
                                        </div>
                                        <div>
                                            <span class="text-proposta"><img class="icon" src="{{asset('img/preco.svg')}}" alt="Ícone de lance mínimo"> Lance mínimo: <b>R$ {{number_format($leilao->valor_minimo, 2,",",".")}}</b></span>
                                        </div>
                                    @endif
                                </div>
                                <div class="row mb-4">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            Documentos
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 ml-2">
                                            @foreach ($startup->documentos as $i => $documento)
                                                <div class="documentos">
                                                    <a href="{{route('documento.arquivo', ['documento' => $documento->id])}}" target="_blank">
                                                        <img  src="{{asset('img/pdf-icon.svg')}}" alt="Ícone de documento" title="Nome do documento">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div>
                                                Contato
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div>
                                                <b>E-mail: </b> {{$startup->email}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div>
                                                <b>Contato: </b> (87) 99999-9999
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('chat', $startup->user)}}" class="btn btn-success btn-color-dafault mb-4">
                                            {{ __('Chat privado') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @if ($proposta->leilao_atual())
                                <div class="w-full md:w-1/4 bg-white pt-3 grid content-between">
                                    <div class="flex flex-wrap">
                                        @forelse ($proposta->leilao_atual()->lances as $index => $lance)
                                            @if(auth()->user() && auth()->user()->investidor && $lance->investidor->id == auth()->user()->investidor->id)
                                                @include('leiloes.lances.edit', ['leilao' => $leilao, 'lance' => $lance])
                                            @endif
                                            <div @class([
                                                    'w-1/2' => $index == 1 || $index == 2,
                                                    'w-full' => $index != 1 && $index != 2,
                                                ])>
                                                <div class="grid justify-content-center">
                                                    <div @class([
                                                            'rounded-full grid place-content-center',
                                                            'h-12 w-12' => $index >= 3,
                                                            'h-16 w-16' => $index < 3,
                                                            'bg-[#EEBC3B]' => $index == 0,
                                                            'bg-[#989898]' => $index == 1,
                                                            'bg-[#BE770C]' => $index == 2,
                                                            'bg-[#C4C4C4]' => $index > 2,
                                                        ])>
                                                        <img src="{{ $lance->investidor->user->profile_photo_url }}" alt="{{ $lance->investidor->user->name }}"
                                                            @class([
                                                                'rounded-full object-cover',
                                                                'h-8 w-8' => $index >= 3,
                                                                'h-12 w-12' => $index < 3,
                                                            ])>
                                                    </div>
                                                </div>
                                                <p class="text-sm font-bold mb-0 text-center">{{ $lance->investidor->user->name }}</p>
                                                <p class="text-xs text-center">R$ {{ number_format($lance->valor, 2,",",".") }}</p>
                                            </div>
                                        @empty
                                            <h3 class="w-full text-center">Nenhum lance realizado</h3>
                                        @endforelse
                                    </div>
                                    <div>
                                        @auth
                                            @if($leilao->esta_no_periodo_de_lances() && auth()->user()->tipo != App\Models\User::PROFILE_ENUM['entrepreneur'])
                                                <div class="w-full grid justify-center">
                                                    {{-- <a href="{{route('leiloes.lances.create', $leilao)}}" class="btn btn-success btn-color-dafault mb-4">
                                                        {{ __('Fazer lance') }}
                                                    </a> --}}
                                                    @if ($leilao->investidor_fez_lance(auth()->user()->investidor))
                                                        <button class="btn btn-success btn-color-dafault mb-4" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            {{ __('Atualizar lance') }}
                                                        </button>
                                                    @else
                                                        @include('leiloes.lances.create', ['leilao' => $leilao])
                                                        <button class="btn btn-success btn-color-dafault mb-4" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            {{ __('Fazer lance') }}
                                                        </button>
                                                    @endif
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($errors) > 0)
        <script type="text/javascript">
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                keyboard: false
            })
            myModal.show()
        </script>
    @endif
    <script>
        cores = ['#00ffff', '#7fffd4', '#8a2be2', '#a52a2a', '#5f9ea0', '#6495ed', '#008b8b', '#bdb76b', '#ff8c00',
                 '#483d8b', '#8fbc8f', '#2f4f4f', '#ffd700', '#20b2aa', '#ffa07a', '#87cefa', '#66cdaa', '#9370db', '#3cb371', '#191970'];

        $(document).ready(function(){
            categoria = document.getElementById('span-area-proposta-startup');

            categoria.style.backgroundColor = cores[parseInt(Math.random() * cores.length)];

            $('#valor').mask('#.##0,00', {
                reverse: true
            });
            $('#menu').click(function() {
                $('#collapseExample').toggleClass('hidden');
                $('#divFormFazerLance').toggleClass('col-lg-9');
            });
        });
    </script>
</x-app-layout>
