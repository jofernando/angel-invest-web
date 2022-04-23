<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

         <!-- Styles -->
         @livewireStyles
        <link rel="stylesheet" href="{{asset('bootstrap-5.1.3/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{asset('bootstrap-5.1.3/js/bootstrap.js')}}"></script>
        <script src="{{asset('jquery/jquery-3.6.min.js')}}"></script>
    </head>
    <body>
        @component('layouts.nav_bar')@endcomponent
        <div id="container-home" class="container">
            <div id="home-box" class="row justify-content-center">
                <div class="col-md-12">
                    <img id="logo-angel-invest" src="{{asset('img/AngelInvest.png')}}" alt="Logo angel invest">
                    <div id="home-text">
                        A AngelInvest é uma startup que visa aproximar investidores-anjo e startups que estão começando no mercado atualmente. Através da nossa plataforma online o dono da startup pode expor seu pitch, plano de negócio, métricas em uma espécie de leilão. Dando a possibilidade do investidor visualizar sua empresa e caso tenha interesse dar um lance. O lance mais alto ao fim do período de exposição pode negociar com o dono da startup.
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container-fluid">
            <div id="row-startups" class="row">
                <div class="col-md-12">
                    <h6>Startups</h6>
                </div>
            </div>
            <div id="row-cards-startups" class="row">
                @if ($leiloes->count() > 0)
                    @foreach ($leiloes as $leilao)
                        {{-- <div class="col-md-4">
                            <div class="card card-home" style="width: 100%;">
                                <div class="row area-startup">
                                    <div class="col-md-9"></div>
                                    <div class="col-md-3">
                                        <span class="span-area-startup" style="color: white;">{{$leilao->proposta->startup->area->nome}}</span>
                                    </div>
                                </div>
                                <img src="img/01.png" class="card-img-top" alt="video da startup">
                                <div class="titles-pitch" class="row">
                                    <div class="col-md-12">
                                        <span class="title-startup">{{mb_strimwidth($leilao->proposta->titulo, 0, 20, "...")}}</span>
                                        <span class="name-startup">{{mb_strimwidth($leilao->proposta->startup->nome, 0, 10, "...")}}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="card-text">{!! mb_strimwidth($leilao->proposta->descricao, 0, 90, "...") !!} @if(strlen($leilao->proposta->descricao) > 90) <a href="{{route('propostas.show', ['startup' => $leilao->proposta->startup, 'proposta' => $leilao->proposta])}}">Exibir proposta</a> @endif</p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <span class="qtd-investor" style="color: white;">10 Teste</span>
                                        </div>
                                        <div class="col-md-8"></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="card card-home border-none" style="width: 100%;">
                                <div class="row area-startup">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4" style="text-align: right; position: relative; right: 10px;">
                                        <span class="span-area-startup" style="color: white;">{{$leilao->proposta->startup->area->nome}}</span>
                                    </div>
                                </div>
                                <video class="card-img-top" alt="video da startup" controls poster="{{asset('storage/'.$leilao->proposta->thumbnail_caminho)}}">
                                    <source src="{{asset('storage/'.$leilao->proposta->video_caminho)}}" type="video/mp4">
                                    <source src="{{asset('storage/'.$leilao->proposta->video_caminho)}}" type="video/mkv">
                                </video>
                                <div id="div-card-hearder" class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a id="idshowa{{$leilao->id}}" href="{{route('propostas.show', ['startup' => $leilao->proposta->startup, 'proposta' => $leilao->proposta])}}" style="color: white; text-decoration: none;"><h4 class="card-title">{{$leilao->proposta->titulo}}</h4></a>
                                            <h5 class="card-subtitle mb-2" style="color: white;">{{$leilao->proposta->startup->nome}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="card-text">{!! mb_strimwidth($leilao->proposta->descricao, 0, 90, "...") !!} @if(strlen($leilao->proposta->descricao) > 90) <a href="{{route('propostas.show', ['startup' => $leilao->proposta->startup, 'proposta' => $leilao->proposta])}}">Exibir proposta</a> @endif</p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <span class="qtd-investor" style="color: white;">10 Teste</span>
                                        </div>
                                        <div class="col-md-8"></div>
                                    </div>
                                    @can('update', $leilao->proposta)
                                        <div class="row mt-3">
                                            <div class="col-md-12" style="text-align: right;">
                                                <a href="{{route('propostas.edit', ['startup' => $leilao->proposta->startup, 'proposta' => $leilao->proposta])}}" class="btn btn-success btn-default btn-padding border"> <img src="{{asset('img/edit.svg')}}" alt="Icone de editar proposta"> Editar</a>
                                                <button id="btnmodaldelete{{$leilao->proposta->id}}" class="btn btn-danger btn-padding border" data-bs-toggle="modal" data-bs-target="#moda-delete-proposta-{{$leilao->proposta->id}}"> <img src="{{asset('img/trash-white.svg')}}" alt="Icone de deletar proposta" style="height: 20px;"> Deletar</button>
                                            </div>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        @can('update', $leilao->proposta)
                            <!-- Modal -->
                            <div class="modal fade" id="moda-delete-proposta-{{$leilao->proposta->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #dc3545;">
                                        <h5 class="modal-title" id="staticBackdropLabel" style="color: white;">Confirmação</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-deletar-proposta-{{$leilao->proposta->id}}" method="POST" action="{{route('propostas.destroy',  ['startup' => $leilao->proposta->startup, 'proposta' => $leilao->proposta])}}">
                                            @csrf
                                            @method('DELETE')
                                            Tem certeza que deseja deletar a proposta {{$leilao->proposta->titulo}}?
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-padding border" data-bs-dismiss="modal">Cancelar</button>
                                        <button id="btnmodaldeleteform{{$leilao->proposta->id}}" type="submit" class="btn btn-danger btn-padding border" form="form-deletar-proposta-{{$leilao->proposta->id}}">Deletar</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endcan
                    @endforeach
                @else
                    <div class="col-md-12 mt-4">
                        <div class="p-5 mb-4 bg-light rounded-3">
                            <div class="container-fluid py-5">
                                <h1 class="display-5 fw-bold">Leilões</h1>
                                <p class="col-md-8 fs-4">Não existem leilões ocorrendo atualmente. <a href="#">Clique aqui</a> para buscar leilões que já ocorreram ou futuros.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        @component('layouts.footer')@endcomponent

        <script>
            $(document).ready(function(){
                categories = document.getElementsByClassName('span-area-startup');
                qtd_investor = document.getElementsByClassName('qtd-investor');
    
                gerar_cores(categories);
                gerar_cores(qtd_investor);
            });
    
            function gerar_cores(html_colletion) {
                for(i = 0; i < html_colletion.length; i++) {
                    html_colletion[i].style.backgroundColor = gerar_cor();
                }
            }
    
            cores = ['#00ffff', '#7fffd4', '#8a2be2', '#a52a2a', '#5f9ea0', '#6495ed', '#008b8b', '#bdb76b', '#ff8c00', 
                     '#483d8b', '#8fbc8f', '#2f4f4f', '#ffd700', '#20b2aa', '#ffa07a', '#87cefa', '#66cdaa', '#9370db', '#3cb371', '#191970'];
            function gerar_cor() {
                return cores[parseInt(Math.random() * cores.length)];
            }
        </script>
    </body>
</html>
