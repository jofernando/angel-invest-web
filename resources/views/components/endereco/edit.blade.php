<div class="card-feature">
    <div class="col-md-12 div-form" style="margin-top: 0px;">
        <p class="text-right"><span style="color: red">*</span> Campos obrigatórios</p>
        <form method="POST" action="{{route('enderecos.update', ['startup' => $startup, 'endereco' => $endereco])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="cep" class="form-label pb-1">CEP <span class="text-red">*</span></label>
                    <input type="cep" id="cep" name="cep" class="form-control border-ternary h-11 @error('cep') is-invalid @enderror" value="{{old('cep', $endereco->cep)}}" required>
                    @error('cep')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="bairro" class="form-label pb-1">Bairro <span class="text-red">*</span></label>
                    <input type="text" id="bairro" name="bairro" class="form-control border-ternary h-11 @error('bairro') is-invalid @enderror" value="{{old('bairro', $endereco->bairro)}}" required>
                    @error('bairro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="rua" class="form-label pb-1">Rua <span class="text-red">*</span></label>
                    <input type="text" id="rua" name="rua" class="form-control border-ternary h-11 @error('rua') is-invalid @enderror" value="{{old('rua', $endereco->rua)}}" required>
                    @error('rua')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="numero" class="form-label pb-1" >Número <span class="text-red">*</span></label>
                    <input type="numero" id="numero" name="numero" class="form-control border-ternary h-11 @error('numero') is-invalid @enderror" value="{{old('numero', $endereco->numero)}}" required>
                    @error('numero')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="estado" class="form-label pb-1">Estado <span class="text-red">*</span></label>
                    <input type="text" id="estado" name="estado" class="form-control border-ternary h-11 @error('estado') is-invalid @enderror" value="{{old('estado', $endereco->estado)}}" required>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="cidade" class="form-label pb-1">Cidade <span class="text-red">*</span></label>
                    <input type="text" id="cidade" name="cidade" class="form-control border-ternary h-11 @error('cidade') is-invalid @enderror" value="{{old('cidade', $endereco->cidade)}}" required>
                    @error('cidade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="complemento" >Complemento</label>
                    <textarea name="complemento" id="complemento" class="form-control border-ternary  @error('complemento') is-invalid @enderror" cols="30" rows="5">{{old('complemento', $endereco->complemento)}}</textarea>
                    @error('complemento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row" style="margin-top: 10px; margin-bottom: 20px;">
                <div class="grid justify-items-center">
                    <button type="submit" class="btn btn-secondary btn-padding border w-80 bg-verde submit-form-btn">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    CKEDITOR.replace( 'complemento' );
    $("#cep").mask("99999-999");
</script>