<x-app-layout>
    <div class="container-fluid" style="margin-bottom: -70px;">
        <div class="row">
            @foreach ($lances as $index => $lance)
                <div
                    @class([
                        "col-md-6 mb-4",
                        'mt-4' => $index < 2
                    ])>
                    <div class="card">
                        <div class="card-body py-0">
                            <div class="row"  style="height: 100%">
                                <div class="col-md-6 py-0 px-0">
                                    <div class="row area-startup" style="margin-top: -24px;">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8" style="text-align: right; position: relative; right: 10px; top: 23px;">
                                            <span class="span-area-startup" style="color: white;">{{$lance->leilao->proposta->startup->area->nome}}</span>
                                        </div>
                                    </div>
                                    <a class="" href="{{route('propostas.show', ['startup' => $lance->leilao->proposta->startup, 'proposta' => $lance->leilao->proposta])}}">
                                        <img class="thumbnail"  src="{{asset('storage/'.$lance->leilao->proposta->thumbnail_caminho)}}" alt="Thumbnail do produto"  style="height: 220px" width="100%">
                                    </a>
                                    <div id="div-card-hearder" class="card-header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{route('propostas.show', ['startup' => $lance->leilao->proposta->startup, 'proposta' => $lance->leilao->proposta])}}" style="color: white; text-decoration: none;"><h5 class="card-title">{{$lance->leilao->proposta->titulo}}</h5></a>
                                                <h6 class="card-subtitle mb-2" style="color: white;">{{$lance->leilao->proposta->startup->nome}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @can('update', $lance->leilao->proposta->startup)
                                        <div class="row mb-4 pl-3">
                                            <div class="col-md-12">
                                                <a href="{{route('leilao.create')}}?produto={{$lance->leilao->proposta->id}}" class="btn btn-success btn-default btn-padding border"><img src="{{asset('img/dolar-bag.svg')}}" alt="Ícone de criar" style="width: 40px;"><span style="font-weight: bolder;">Criar leilão</span></a>
                                            </div>
                                        </div>
                                    @endcan
                                    <div class="row mb-4 pl-3 mt-3">
                                        @if ($leilao = $lance->leilao->proposta->leilao_atual())
                                            <div>
                                                <span class="text-proposta" style="font-size: 14px"><img class="icon" src="{{asset('img/calendar.svg')}}" alt="Ícone de calendario"> Lances durante: <b>{{date('d/m', strtotime($leilao->data_inicio))}} a {{date('d/m', strtotime($leilao->data_fim))}}</b></span>
                                            </div>
                                            <div>
                                                <span class="text-proposta" style="font-size: 14px"><img class="icon" src="{{asset('img/preco.svg')}}" alt="Ícone de lance mínimo"> Lance mínimo: <b>R$ {{number_format($leilao->valor_minimo, 2,",",".")}}</b></span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row pl-3">
                                        <div class="row">
                                            <div class="col-md-12" style="font-size: 16px">
                                                Contato
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" style="font-size: 14px">
                                                <span style="font-weight: bolder;">E-mail: </span> {{$lance->leilao->proposta->startup->email}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" style="font-size: 14px">
                                                <span style="font-weight: bolder;">Contato: </span> (87) 99999-9999
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($lance->leilao->proposta->leilao_atual())
                                    <div class="col-md-6 bg-fundo pt-3 grid content-between">
                                        @forelse ($lance->leilao->proposta->leilao_atual()->lances as $index => $lance)
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
                                                <p @class([
                                                        'text-sm font-bold mb-0 text-center',
                                                        'text-blue-500' => $lance->investidor->user->id == auth()->user()->id,
                                                    ])>
                                                    @if ($lance->investidor->user->id == auth()->user()->id)
                                                        Você
                                                    @else
                                                        {{ $lance->investidor->user->name }}
                                                    @endif
                                                </p>
                                                <p class="text-xs text-center">R$ {{ number_format($lance->valor, 2,",",".") }}</p>
                                            </div>
                                        @empty
                                            <h3 class="w-full text-center">Nenhum lance realizado</h3>
                                        @endforelse
                                        <div>
                                            @if(!$leilao->lances()->take($leilao->numero_ganhadores)->get()->pluck('investidor_id')->contains(auth()->user()->investidor->id))
                                                <div class="bg-[#FFD6D6] text-center py-3 mx-4 mb-2 px-2 text-[#2F0E0E]">
                                                    Faça um lance maior que R$ {{ number_format($leilao->valor_corte(), 2, ',', '.') }} para conseguir o produto
                                                </div>
                                            @endif
                                            <div class="w-full grid justify-center">
                                                <a href="{{route('leiloes.lances.create', $leilao)}}" class="btn btn-success btn-color-dafault mb-4">
                                                    {{ __('Atualizar lance') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        cores = ['#00ffff', '#7fffd4', '#8a2be2', '#a52a2a', '#5f9ea0', '#6495ed', '#008b8b', '#bdb76b', '#ff8c00',
                 '#483d8b', '#8fbc8f', '#2f4f4f', '#ffd700', '#20b2aa', '#ffa07a', '#87cefa', '#66cdaa', '#9370db', '#3cb371', '#191970'];

        $(document).ready(function(){
            $('.span-area-startup').each(function(index, element) {
                element.style.backgroundColor = cores[parseInt(Math.random() * cores.length)]
            });
        });
    </script>
</x-app-layout>
