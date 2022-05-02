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
        <form method="POST" action="{{ route('telefones.update', $startup) }}" enctype="multipart/form-data" class="form-envia-documentos">
            @csrf
            <div class="col-sm-12 form-group">
                @if (old('numeros') == null)
                    <div class="row">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="numeros" class="form-label ">Número<span style="color: red;">*</span></label>
                                <input name="numeros[]" type="text" class="form-control @error('numeros.*') is-invalid @enderror" placeholder="Digite seu número de telefone aqui..." required value="{{old('numeros')}}">
                                @error('numeros.*')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="docs_indice" value="0">
                @endif
                <div id="docs" class="row">
                    @if (old('numeros') != null)
                        <input type="hidden" id="docs_indice"
                            value="{{ count(old('numeros')) - 1 }}">
                        @foreach (old('numeros') as $i => $doc)
                            <div class="row" @if($i > 0) style="margin-top: 10px;" @endif>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="numeros" class="form-label ">Número<span style="color: red;">*</span></label>
                                        <input name="numeros[]" type="text" class="form-control @error('numeros. '.$i) is-invalid @enderror" placeholder="Digite seu número de telefone aqui..." required value="{{ $doc }}">
                                        @error('numeros.'. $i)
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <input type="hidden" id="docs_indice" value="0">
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

