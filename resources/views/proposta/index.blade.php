<x-app-layout>
    <div class="container index-proposta" style="margin-top: 50px;">
        <div class="row titulo-pag">
            <div class="col-md-8">
                <h4>Minhas startups > {{mb_strimwidth($startup->nome, 0, 30, "...")}} > Propostas </h4>
            </div>
            <div class="col-md-4" style="text-align: right;">
                <span class="span-btn-add"><a href="{{route('propostas.create', $startup)}}" class="btn btn-success btn-default btn-padding border"> <img src="{{asset('img/idea.svg')}}" alt="ìcone de adicionar nova proposta"> Adicionar novo proposta</a></span>
            </div>
        </div>
        <div class="row">
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
            @elseif(session('error'))
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                      </symbol>
                </svg>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        {{session('error')}}
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            @foreach ($propostas as $proposta)
                <div class="col-md-4">
                    <div class="card card-home" style="width: 100%;">
                        <div class="row area-startup">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <span class="span-area-startup" style="color: white;">{{$proposta->startup->area->nome}}</span>
                            </div>
                        </div>
                        {{-- {{dd($proposta->thumbnail_caminho)}} --}}
                        <video class="card-img-top" alt="video da startup" controls poster="{{asset('storage/'.$proposta->thumbnail_caminho)}}">
                            <source src="{{asset('storage/'.$proposta->video_caminho)}}" type="video/mp4">
                            <source src="../video/mov_bbb.mp4" type="video/mkv">
                        </video>
                        <div class="titles-pitch" class="row">
                            <div class="col-md-12">
                                <span class="title-startup">{{$proposta->titulo}}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="card-title">{{$proposta->startup->nome}}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-text">{!! mb_strimwidth($startup->descricao, 0, 90, "...") !!} <a href="{{route('propostas.show', ['startup' => $startup, 'proposta' => $proposta])}}">Exibir proposta</a></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12" style="text-align: right;">
                                    <a href="{{route('propostas.edit', ['startup' => $startup, 'proposta' => $proposta])}}" class="btn btn-success btn-default btn-padding border">Editar</a>
                                    <button class="btn btn-danger btn-padding border" data-bs-toggle="modal" data-bs-target="#moda-delete-proposta-{{$proposta->id}}">Deletar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="moda-delete-proposta-{{$proposta->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #dc3545;">
                            <h5 class="modal-title" id="staticBackdropLabel" style="color: white;">Confirmação</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-deletar-proposta-{{$proposta->id}}" method="POST" action="{{route('propostas.destroy',  ['startup' => $startup, 'proposta' => $proposta])}}">
                                @csrf
                                @method('DELETE')
                                Tem certeza que deseja deletar a proposta {{$proposta->titulo}}?
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-padding border" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger btn-padding border" form="form-deletar-proposta-{{$proposta->id}}">Deletar</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </div>   
    </div>
</x-app-layout>