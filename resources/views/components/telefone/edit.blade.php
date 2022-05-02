<div class="card-feature">
    <div class="col-md-12 div-form" style="margin-top: 0px;">
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
        <form method="POST" action="{{route('telefones.update', ['startup' => $startup])}}" enctype="multipart/form-data" class="form-envia-documentos">
            @csrf
            @method('PUT')
            <div class="container" style="margin-top: 15px; margin-bottom: 15px;">
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
                                    <input name="numeros[]" type="text" class="form-control @error('numeros. '.$i) is-invalid @enderror" placeholder="Digite seu telefone aqui..." value="{{old('numeros.'.$i, $tel->numero)}}" oninput="mascaraTelefone(this);">
                                    @error('numeros.'. $i)
                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12" >
                                @if($i > 0)
                                    <a  onclick="this.parentElement.parentElement.remove()" style="margin-top: 10px; cursor: pointer">
                                        <img width="20px;" src="{{asset('img/trash.svg')}}"  alt="Apagar" title="Apagar">
                                    </a>
                                @endif
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
                                            <input name="numeros[]" type="text" class="form-control @error('numeros. '.$i) is-invalid @enderror" placeholder="Digite seu telefone aqui..." value="{{old('numeros.'.$i, $doc)}}" oninput="mascaraTelefone(this);">
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

<script>
    function addDoc() {
        var indice = document.getElementById("docs_indice");
        var doc_indice = parseInt(document.getElementById("docs_indice").value) + 1;
        indice.value = doc_indice;
        var doc = `<div class="row" style="margin-top: 10px;">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="numeros" class="form-label ">Número<span style="color: red;">*</span></label>
                                <input name="numeros[]" type="text" class="form-control" placeholder="Digite o seu telefone aqui..." required oninput="mascaraTelefone(this);">
                                <a  onclick="this.parentElement.parentElement.remove()" style="margin-top: 10px; cursor: pointer">
                                    <img width="20px;" src="{{asset('img/trash.svg')}}"  alt="Apagar" title="Apagar">
                                </a>
                            </div>
                        </div>
                    </div>`;
        $('#docs').append(doc);
    }
    function mascaraTelefone(numero) {
        var behavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {
            onKeyPress: function (val, e, field, options) {
                field.mask(behavior.apply({}, arguments), options);
            }
        };
        $(numero).mask(behavior, options);
    }
</script>

