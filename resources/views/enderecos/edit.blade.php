<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit endereco') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container">
                <div class="row">
                  <div id ="menu_startup" class="col-6 col-md-4">
                      <h5>Adicionando nova startup</h5>
                  </div>
                  <div class="col-md-8">
                    <h4 id="titulo_end">Endereço Editar</h4>
                    <p class="text-right"><span style="color: red">*</span> Campos obrigatórios</p>
                    <form id="formulario" method="POST" action="{{route('enderecos.update', ['startup' => $startup, 'endereco' => $endereco])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @csrf
                        @method('PUT')
                        <div class="lado-a-lado1">
                            <div class="form-group">
                                <label for="cep" class="required" style="font-weight: normal">CEP</label>
                                <input type="cep" class="form-control" id="cep" name="cep" value="{{old('cep', $endereco->cep)}}">
                            </div>
                            <div class="form-group">
                                <label for="bairro" class="required" style="font-weight: normal">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{old('bairro', $endereco->bairro)}}">
                            </div>
                        </div>
                        <div class="lado-a-lado2">
                            <div class="form-group">
                                <label for="rua" class="required lado-a-lado" style="font-weight: normal">Rua</label>
                                <input type="text" class="form-control" id="rua" name="rua" value="{{old('rua', $endereco->rua)}}">
                            </div>
                            <div class="form-group">
                                <label for="numero" class="required" style="font-weight: normal">Número</label>
                                <input type="numero" class="form-control" id="numero" name="numero" value="{{old('numero', $endereco->numero)}}">
                            </div>
                        </div>
                        <div class="lado-a-lado3">
                            <div class="form-group">
                                <label for="estado" class="required" style="font-weight: normal">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" value="{{old('estado', $endereco->estado)}}">
                            </div>
                            <div class="form-group">
                                <label for="cidade" class="required" style="font-weight: normal">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" value="{{old('cidade', $endereco->cidade)}}">
                            </div>
                        </div>
                        <div class="form-group" id="complemento_editar">
                            <label for="complemento" style="font-weight: normal">Complemento</label>
                            <textarea name="complemento" id="complemento" class="form-control" cols="30" rows="3">{{old('complemento', $endereco->complemento)}}</textarea>
                        </div>
                            <button id= "botao_voltar" type="" class="btn btn-primary mb-2 botaoVoltar" style=" ">&#x2190</button>
                            <button id= "botao_enviar" type="submit" class="btn btn-primary mb-2 botaoEnviar">Salvar</button>
                    </form>
                    <div class="row">
                        <div id="bottom_form" class="col-md-12"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace( 'complemento' );
        $("#cep").mask("99999-999");
    </script>
</x-app-layout>
