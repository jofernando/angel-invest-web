<x-app-layout>
    <div class="container-fluid" style="margin-bottom: -70px;">
        <div class="row">
            <div class="col-md-12">
                <a id="btn-voltar" href="{{route('propostas.index', $startup)}}" class="btn btn-success btn-padding border" style="font-size: 22px;"><img src="{{asset('img/back.svg')}}" alt="Icone de voltar" style="padding-right: 10px;"> Voltar</a>
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
                                <h3>Titulo do pitch</h3>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <span id="span-area-proposta-startup">{{$startup->area->nome}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h4 class="card-title">{{$proposta->titulo}}</h4>
                                <p class="card-text">
                                    {!! $proposta->descricao !!}
                                </p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-default btn-padding border"><img src="{{asset('img/dolar-bag.svg')}}" alt="Ícone de criar" style="width: 40px;"><span style="font-weight: bolder;">Criar leilão</span></button>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="row">
                                <div class="col-md-12">
                                    Documentos
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="documentos"><img  src="{{asset('img/pdf-icon.svg')}}" alt="Ícone de documento" title="Nome do documento"></div>
                                    <div class="documentos"><img  src="{{asset('img/pdf-icon.svg')}}" alt="Ícone de documento" title="Nome do documento"></div>
                                    <div class="documentos"><img  src="{{asset('img/pdf-icon.svg')}}" alt="Ícone de documento" title="Nome do documento"></div>
                                    <div class="documentos"><img  src="{{asset('img/pdf-icon.svg')}}" alt="Ícone de documento" title="Nome do documento"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    Contato
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span style="font-weight: bolder;">E-mail: </span> teste@example.com
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span style="font-weight: bolder;">Contato: </span> (87) 99999-9999
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        cores = ['#00ffff', '#7fffd4', '#8a2be2', '#a52a2a', '#5f9ea0', '#6495ed', '#008b8b', '#bdb76b', '#ff8c00', 
                 '#483d8b', '#8fbc8f', '#2f4f4f', '#ffd700', '#20b2aa', '#ffa07a', '#87cefa', '#66cdaa', '#9370db', '#3cb371', '#191970'];

        $(document).ready(function(){
            categoria = document.getElementById('span-area-proposta-startup');

            categoria.style.backgroundColor = cores[parseInt(Math.random() * cores.length)];
        });
    </script>
</x-app-layout>