<x-app-layout>
    <div class="container" style="margin-top: 30px;">
        <div class="row titulo-pag">
            <div class="col-md-8">
                <h4><a class="link-default" href="{{route('startups.index')}}">Minhas startups</a> > <a class="link-default" href="{{route('startups.show', $startup)}}">{{mb_strimwidth($startup->nome, 0, 30, "...")}}</a> > Editando documentos</h4>
            </div>
        </div>
        <div class="card card-feature" style="margin-top:25px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 div-checks">
                        <div class="row mb-4 mt-4" style="text-align: center;">
                            <div class="col-md-12">
                                <a href="{{route('startups.show', $startup)}}" class="btn btn-success btn-padding border"><img src="{{asset('img/back.svg')}}" alt="Icone de voltar" style="padding-right: 5px; height: 22px;"> Voltar</a>
                            </div>
                        </div>
                        <div class="row">
                            <div id ="left-div-create" class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 side-titulo"  style="text-align: center">
                                        Editando telefones de {{$startup->nome}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 div-form">
                        <div class="card-body" >
                            <div style="margin-top: 15px; margin-bottom: 15px;">
                                <div class="col-md-12">
                                    <div class="bg-[#F3F3F3]">
                                        <form method="POST" action="{{route('telefones.update', ['startup' => $startup])}}" enctype="multipart/form-data" class="form-envia-documentos">
                                            @csrf
                                            @method('PUT')
                                            <div class="container" style="margin-top: 15px; margin-bottom: 15px;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h2>Telefone</h2>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
                                                    <div class="col-md-6">
                                                        <span class="span-btn-add" id="btn-adicionar-escolhar" onclick="addDoc()">
                                                          <a class="btn btn-success btn-default btn-padding border">
                                                            <img src="{{asset('img/add-document.svg')}}" alt="">
                                                            Novo telefone
                                                          </a>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="text-right"><span style="color: red">*</span> Campos obrigatórios</p>
                                                    </div>
                                                </div>
                                                <div id="docs" class="col-sm-12 form-group">
                                                    @if(old('numeros') != null)
                                                        <input type="hidden" id="docs_indice" value="{{count(old('numeros'))-1}}">
                                                    @else
                                                        <input type="hidden" id="docs_indice" value="{{$telefones->count()-1}}">
                                                    @endif
                                                    @foreach ($telefones as $i => $tel)
                                                        <div class="row" @if($i > 0) style="margin-top: 10px;" @endif>
                                                            <input type="hidden" name="docsID[]" value="{{$tel->id}}">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <label for="numeros" class="form-label ">{{$tel->numero}}</label>
                                                                    <input name="numeros[]" type="text" class="form-control @error('numeros. '.$i) is-invalid @enderror" placeholder="Digite seu telefone aqui..." value="{{old('numeros.'.$i, $tel->numero)}}">
                                                                    @error('numeros.'. $i)
                                                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if(old('numeros') != null)
                                                        @foreach (old('numeros') as $i => $doc)
                                                            @if($i > $telefones->count()-1)
                                                                <div class="row" @if($i > 0) style="margin-top: 10px;" @endif>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-12">
                                                                            <label for="numeros" class="form-label ">{{$doc}}</label>
                                                                            <input name="numeros[]" type="text" class="form-control @error('numeros. '.$i) is-invalid @enderror" placeholder="Digite seu telefone aqui..." value="{{old('numeros.'.$i, $doc)}}">
                                                                            @error('numeros.'. $i)
                                                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 10px; margin-bottom: 20px;">
                                                <div class="grid justify-items-center">
                                                    <button id="submitForm" type="submit" class="btn btn-secondary btn-padding border w-80 bg-verde submit-form-btn">Salvar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="text-align: left;">
                    <div class="col-md-4"></div>
                    <div class="col-md-8" style="position: relative; left: -22px; padding-right: -200px;">
                        <div class="bottom-form" class="row mt-3" style="margin-left: 10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addDoc() {
            var indice = document.getElementById("docs_indice");
            var doc_indice = parseInt(document.getElementById("docs_indice").value) + 1;
            indice.value = doc_indice;
            var doc = `<div class="row" style="margin-top: 10px;">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="numeros" class="form-label ">Número<span style="color: red;">*</span></label>
                                    <input name="numeros[]" type="text" class="form-control" placeholder="Digite o seu telefone aqui..." required>
                                    <a  onclick="this.parentElement.parentElement.remove()" style="margin-top: 10px; cursor: pointer">
                                    <img width="20px;" src="{{asset('img/trash.svg')}}"  alt="Apagar" title="Apagar">
                                    </a>
                                </div>
                            </div>
                        </div>`;
            $('#docs').append(doc);
        }

    </script>
</x-app-layout>
