<x-app-layout>
    <div class="container index-proposta" style="margin-top: 30px;">
        <div class="row titulo-pag">
            <div class="col-md-12">
                <h4>Minhas startups > {{mb_strimwidth($startup->nome, 0, 30, "...")}}</h4>
            </div>
        </div>
        <div id="info">
            <div class="py-12 ">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-between pt-3">
                            <div class="col-md-6">
                                <h2>Informações básicas</h2>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('startups.edit', ['startup' => $startup])}}" class="btn btn-success btn-default btn-padding border"> <img src="{{asset('img/edit.svg')}}" alt="Icone de editar proposta"> Editar</a>
                            </div>
                        </div>
                    </div>
                    <div class="pb-3" style="margin-top: 10px">
                        <label class="form-label" for="nome">Nome</label>
                        <input type="text"
                            class="form-control border-ternary h-11"
                            id="nome"
                            name="nome"
                            value="{{ old('nome', $startup->nome) }}"
                            disabled
                            >
                    </div>
                    <div class="pb-3">
                        <label class="form-label" for="descricao">Descrição</label>
                        <textarea name="descricao"
                            id="descricao"
                            class="form-control border-ternary"
                            cols="30"
                            rows="3"
                            disabled>{{ old('descricao', $startup->descricao) }}</textarea>
                    </div>
                    <div class="row">
                        <div class="pb-3 col-6">
                            <label class="form-label" for="cnpj">CNPJ</label>
                            <input type="text"
                                class="form-control border-ternary h-11"
                                id="cnpj"
                                name="cnpj"
                                value="{{ old('cnpj', $startup->cnpj) }}"
                                disabled>
        
                        </div>
                        <div class="pb-3 col-6">
                            <label class="form-label" for="area">Área</label>
                            <select id="area"
                                name="area"
                                class="form-select border-ternary h-11"
                                disabled>
                                    <option value="{{ $startup->area->id }}">
                                        {{ $startup->area->nome  }}
                                    </option selected>
                            </select>
                        </div>
                    </div>
                    <div class="pb-3">
                        <label class="form-label" for="email">E-mail</label>
                        <input type="email"
                            class="form-control border-ternary h-11"
                            id="email"
                            name="email"
                            value="{{ old('email', $startup->email) }}"
                            disabled>
                    </div>
                    <div class="pb-3">
                        <label class="form-label" for="logo">Logo</label>
                        <input type="file"
                            name="logo"
                            class="form-control-file d-none"
                            id="logo">
                        <div class="w-32 h-32">
                            <div class="w-full h-full bg-black rounded-full flex items-center justify-center align-middle relative overflow-hidden">
                                <img id="logo-display" src="{{ asset('storage/'.$startup->logo) }}" alt="" class="h-28 py-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="endereco">
            <div class="row titulo-pag">
            </div>
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-between pt-3">
                            <div class="col-md-6">
                                <h2>Endereço</h2>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('enderecos.edit', ['startup' => $startup, 'endereco' => $startup->endereco])}}" class="btn btn-success btn-default btn-padding border"> <img src="{{asset('img/edit.svg')}}" alt="Icone de editar proposta"> Editar</a>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <label for="cep" class="form-label pb-1">CEP</label>
                            <input type="text" id="cep" name="cep" class="form-control border-ternary h-11" value="{{old('cep', $startup->endereco->cep)}}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="bairro" class="form-label pb-1">Bairro</label>
                            <input type="text" id="bairro" name="bairro" class="form-control border-ternary h-11" value="{{old('bairro', $startup->endereco->bairro)}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="rua" class="form-label pb-1">Rua</label>
                            <input type="text" id="rua" name="rua" class="form-control border-ternary h-11" value="{{old('rua', $startup->endereco->rua)}}" disabled>
                            @error('rua')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="numero" class="form-label pb-1" >Número</label>
                            <input type="numero" id="numero" name="numero" class="form-control border-ternary h-11" value="{{old('numero', $startup->endereco->numero)}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="estado" class="form-label pb-1">Estado</label>
                            <input type="text" id="estado" name="estado" class="form-control border-ternary h-11" value="{{old('estado', $startup->endereco->estado)}}" disabled>

                        </div>
                        <div class="col-md-6">
                            <label for="cidade" class="form-label pb-1">Cidade</label>
                            <input type="text" id="cidade" name="cidade" class="form-control border-ternary h-11" value="{{old('cidade', $startup->endereco->cidade)}}" disabled>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="complemento" >Complemento</label>
                            <textarea name="complemento" id="complemento" class="form-control border-ternary" cols="30" rows="5" disabled>{{old('complemento', $startup->endereco->complemento)}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="documentos">
            <div class="row titulo-pag">
            </div>
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h2>Documentos</h2>
                    @foreach ($startup->documentos as $i => $documento)
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nome_{{$i}}" class="form-label pb-1">{{$i+1}} - {{$documento->nome}}</label>
                                <a href="{{route('documento.arquivo', ['documento' => $documento->id])}}" target="_blank"><img src="{{asset('img/file-pdf-solid.svg')}}" alt="documento {{$documento->nome}}" style="width: 16px;"></a>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
