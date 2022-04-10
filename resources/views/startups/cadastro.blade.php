<x-app-layout>
    <div id="container-home" class="container" style="margin-top: 40px;">
        <div class="col-md-12">
            <div class="card card-register mb-3" style="max-width: 100%;">
                <div id="card-container" class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div id ="left-div-create" class="col-md-12"> 
                                        <div class="row">
                                            <div class="col-md-12 side-titulo"  style="text-align: center">
                                                Adicionando nova startup
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center justify-content-between pt-3">
                                                <div class="col-md-1">
                                                    @if(is_null($startup))
                                                        <div class="circulo-selected">
                                                            <div class="numero-selected">
                                                                1
                                                            </div>
                                                        </div>
                                                    @else
                                                        <img width="30" src="{{asset('img/etapa-completa.svg')}}" alt="Ícone de etapa concluída">
                                                    @endif
                                                </div>
                                                <div class="col-md-11" >
                                                    <button id="botao-info" class="etapa-nome-selected" onclick="alterarTituloEtapa(this, 'Informações básicas')">Informações básicas</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center justify-content-between pt-3">
                                                <div class="col-md-1">
                                                    @if(is_null($startup) || is_null($startup->endereco))
                                                        <div class="circulo">
                                                            <div class="numero">
                                                                2
                                                            </div>
                                                        </div>
                                                    @else
                                                        <img width="30" src="{{asset('img/etapa-completa.svg')}}" alt="Ícone de etapa concluída">
                                                    @endif
                                                </div>
                                                <div class="col-md-11">
                                                    <button id="botao-endereco" class="etapa-nome" @if(is_null($startup)) disabled @endif onclick="alterarTituloEtapa(this, 'Endereço')">Endereço</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center justify-content-between pt-3">
                                                <div class="col-md-1">
                                                    @if(is_null($startup) || is_null($startup->telefones))
                                                        <div class="circulo">
                                                            <div class="numero">
                                                                3
                                                            </div>
                                                        </div>
                                                    @else
                                                        <img width="30" src="{{asset('img/etapa-completa.svg')}}" alt="Ícone de etapa concluída">
                                                    @endif
                                                </div>
                                                <div class="col-md-11">
                                                    <button id="botao-telefone" class="etapa-nome" @if(is_null($startup)) disabled @endif onclick="alterarTituloEtapa(this, 'Telefone')">Telefone</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center justify-content-between pt-3">
                                                <div class="col-md-1">
                                                    @if(is_null($startup) || is_null($startup->documentos))
                                                        <div class="circulo">
                                                            <div class="numero">
                                                                4
                                                            </div>
                                                        </div>
                                                    @else
                                                        <img width="30" src="{{asset('img/etapa-completa.svg')}}" alt="Ícone de etapa concluída">
                                                    @endif
                                                </div>
                                                <div class="col-md-11">
                                                    <button id="botao-docs" class="etapa-nome" @if(is_null($startup)) disabled @endif onclick="alterarTituloEtapa(this, 'Documentos')">Documentos</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" style="background-color: #F3F3F3">
                                <div class="card-body" >
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 id="titulo-etapa" class="card-title">Informações básicas</h3>
                                            </div>
                                            <div id="componente">
                                                @if(is_null($startup))
                                                    <script>
                                                        $(document).ready(function(){
                                                            alterarTituloEtapa($('#botao-info'), 'Informações básicas');
                                                        });
                                                    </script>
                                                @elseif(is_null($startup->endereco))
                                                    <script>
                                                        $(document).ready(function(){
                                                            alterarTituloEtapa($('#botao-endereco')[0], 'Endereço');
                                                        });
                                                    </script>
                                                @elseif(is_null($startup->telefones))
                                                    <script>
                                                        $(document).ready(function(){
                                                            alterarTituloEtapa($('#botao-telefone')[0], 'Telefone');
                                                        });
                                                    </script>
                                                @elseif(is_null($startup->documentos))
                                                    <script>
                                                        $(document).ready(function(){
                                                            alterarTituloEtapa($('#botao-docs')[0], 'Documentos');
                                                        });
                                                    </script>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="bottom-left-div-create" class="col-md-4"></div>
                            <div id="bottom-form" class="col-md-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function alterarTituloEtapa(botao, nome_etapa){
            var titulo = document.getElementById("titulo-etapa");
            console.log(botao);
            if(nome_etapa != titulo.innerText){
                $(".etapa-nome-selected").addClass('etapa-nome');
                $(".etapa-nome-selected").removeClass('etapa-nome-selected');
                $(".circulo-selected").addClass('circulo');
                $(".circulo-selected").removeClass('circulo-selected');
                $(".numero-selected").addClass('numero');
                $(".numero-selected").removeClass('numero-selected');

                $(botao).removeClass('etapa-nome');
                $(botao).addClass('etapa-nome-selected');
                $(botao.parentElement.parentElement.children[0].children[0]).removeClass('circulo');
                $(botao.parentElement.parentElement.children[0].children[0]).addClass('circulo-selected');
                $(botao.parentElement.parentElement.children[0].children[0].children[0]).removeClass('numero');
                $(botao.parentElement.parentElement.children[0].children[0].children[0]).addClass('numero-selected');

                
            }
            titulo.innerText = nome_etapa;
            $.ajax({
                url:"{{route('startup.component.ajax')}}",
                type:"get",
                data: {"etapa_nome": nome_etapa},
                success: function(component) {
                    $("#componente").html(component);
                }
            }); 
        }
    </script>
</x-app-layout>