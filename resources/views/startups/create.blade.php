    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create startup') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#F3F3F3]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1>Informações básicas</h1>
            <p class="text-right"><span class="text-red">*</span> Campos obrigatórios</p>
            <form action="{{ route('startups.store') }}"
                enctype="multipart/form-data"
                method="POST">
                @csrf
                <div class="pb-3">
                    <label class="form-label text-xl pb-2" for="nome">Nome <span class="text-red">*</span></label>
                    <input type="text"
                        class="form-control border-ternary h-11 @error('nome') is-invalid @enderror"
                        id="nome"
                        name="nome"
                        value="{{ old('nome') }}"
                        placeholder="Insira o nome da startup aqui...">
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="pb-3">
                    <label class="form-label text-xl pb-2" for="descricao">Descrição <span class="text-red">*</span></label>
                    <small class="ps-4 ms-3">Forneça uma breve descrição da sua startup</small>
                    <textarea name="descricao"
                        id="descricao"
                        class="form-control border-ternary @error('descricao') is-invalid @enderror"
                        cols="30"
                        rows="3">{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="row">
                    <div class="pb-3 col-6">
                        <label class="form-label text-xl pb-2" for="cnpj">CNPJ <span class="text-red">*</span></label>
                        <input type="text"
                            class="form-control border-ternary h-11 @error('cnpj') is-invalid @enderror"
                            id="cnpj"
                            name="cnpj"
                            value="{{ old('cnpj') }}"
                            placeholder="Digite aqui o CNPJ da startup...">
                            @error('cnpj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="pb-3 col-6">
                        <label class="form-label text-xl pb-2" for="area">Área <span class="text-red">*</span></label>
                        <select id="area"
                            name="area"
                            class="form-select border-ternary h-11 @error('area') is-invalid @enderror">
                            <option selected disabled hidden>Selecione a área que mais se aproxima da sua startup...</option>
                            @foreach ($areas as $id => $area)
                                <option value="{{ $id }}"
                                    {{ old('area') == $id ? 'selected' : '' }}>
                                    {{ $area }}
                                </option>
                            @endforeach
                        </select>
                        @error('area')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="pb-3">
                    <label class="form-label text-xl pb-2" for="email">E-mail <span class="text-red">*</span></label>
                    <input type="email"
                        class="form-control border-ternary h-11 @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Digite o email para contato...">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="pb-3">
                    <label class="form-label text-xl pb-2" for="logo">Logo <span class="text-red">*</span></label>
                    <input type="file"
                        name="logo"
                        class="form-control-file d-none @error('logo') is-invalid @enderror"
                        id="logo">
                    <div class="w-32 h-32" onclick="$('#logo').click()">
                        <div class="w-full h-full bg-black rounded-full flex items-center justify-center align-middle relative overflow-hidden">
                            <img id="logo-display" src="{{asset('img/logo-padrao.svg')}}" alt="" class="h-28 py-2">
                            <div id="desc-logo" class="absolute inset-0 branco-transparente mt-20 h-8">
                                <div class="text-xs font-normal text-center opacity-100 text-ternary">
                                    Adicione o logo da startup
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="grid justify-items-center">
                    <button type="submit" class="btn btn-secondary w-80 bg-verde">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $("#cnpj").mask("99.999.999/9999-99");
        function display(input) {
            const [file] = input.files
            if (file) {
                $("#logo-display").attr('src', URL.createObjectURL(file))
            }
        }

        $("#logo").change(function() {
            display(this);
            $('#desc-logo').addClass('d-none');
        });
    </script>
