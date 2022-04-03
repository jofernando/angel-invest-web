<x-guest-layout>
    <div id="container-home" class="container">
        <div class="col-md-12">
            <div class="card card-register mb-3" style="max-width: 100%;">
                <div id="card-container" class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div id="colum-img" class="col-md-5">
                                <div class="row">
                                    <div id="top-img-div" class="col-md-12"></div>
                                </div>
                                <div id="bottom-img-div" class="row" style="text-align: center">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <img id="img-illustrative" src="@if(old('profile') == \App\Models\User::PROFILE_ENUM['investor']){{asset('img/investidor-preto-quad.png')}}@else{{asset('img/empreendedor-preto.svg')}}@endif" alt="Imagem ilustrativa empreendedor">
                                            </div>
                                        </div>
                                        <div id="btn-div" class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Você é... ?
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                            <button id="btn-entrepreneur" class="btn btn-outline-investidor-empreendedor @if(old('profile') == \App\Models\User::PROFILE_ENUM['investor']) @else selected @endif" type="button" onclick="alterar_img('{{asset('img/empreendedor-preto.svg')}}', 'entrepreneur-registration')">Empreendedor</button>
                                                            <button id="btn-investor" class="btn btn-outline-investidor-empreendedor @if(old('profile') == \App\Models\User::PROFILE_ENUM['investor']) selected @endif" type="button" onclick="alterar_img('{{asset('img/investidor-preto-quad.png')}}', 'investor-registration')">Investidor-anjo</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center" style="padding-top: 40px;">
                                            <div id="text-entrepreneur" class="col-md-12">
                                                Cadastrando-se como empreendedor você poderá criar sua startup, 
                                                assim como suas propostas para aquela startup, 
                                                podendo logo após utilizar da exibição da mesma, 
                                                aonde investidores-anjo poderam visualizar sua prosposta por um
                                                determinador periodo, caso desejem poderão também fazer ofertas de
                                                negociações futuras caso você deseje.
                                            </div>
                                            <div id="text-investor" class="col-md-12" style="display: none;">
                                                Cadastrando-se como investidor você poderá visualizar exibições de 
                                                propostas das startups emergentes. Caso deseje fazer uma oferta de aporte 
                                                a startup, você deve realizar um deposito na sua carteira da angel invest.
                                                Deixamos claro que ofertas não são transferencias diretas as startups e sim 
                                                valores simbólicos que poderão ser negociados após sua colocação ser definida
                                                no final da exibição da proposta. Um valor é cobrado em cima da oferta, para
                                                saber mais sobre os valores <a href="#">clique aqui</a>. 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <div id="form-registration" class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 id="investor-registration" class="card-title" style="display: none;">Cadastro de <span style="color: rgb(41, 103, 129);">investidor-anjo</span></h3>
                                                <h3 id="entrepreneur-registration" class="card-title">Cadastro de <span style="color: rgb(41, 103, 129);">empreendedor</span></h3>
                                            </div>
                                        </div>
                                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input id="profile" type="hidden" name="profile" value="{{\App\Models\User::PROFILE_ENUM['entrepreneur']}}">
                                            <div class="row mb-3" style="text-align: right;">
                                                <div class="col-md-9"></div>
                                                <div class="col-md-3" style="text-align: center">
                                                    <label id="label-photo" for="foto_do_perfil" class="form-label">Foto do perfil</label>
                                                    <img id="input-profile-photo" src="img/perfil.svg" alt="Imagem default perfil" onclick="click_file_input()">
                                                    <div style="display: none;">
                                                        <input id="foto_do_perfil" name="foto_do_perfil" type="file" class="form-control" accept="png">
                                                    </div>
                                                    @error('foto_do_perfil')
                                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row" style="text-align: right;">
                                                <div class="col-md-12">
                                                    <span style="color: red;">*</span> Campo obrigatório
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label for="nome" class="form-label">Nome <span style="color: red;">*</span></label>
                                                    <input value="{{old('nome')}}" id="nome" name="nome" type="text" class="form-control @error('nome') is-invalid @enderror" placeholder="Digite seu nome aqui..." required>

                                                    @error('nome')
                                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                                                    <input value="{{old('email')}}" id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@gmail.com" required>

                                                    @error('email')
                                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cpf" class="form-label">CPF <span style="color: red;">*</span></label>
                                                    <input value="{{old('cpf')}}" id="cpf" name="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" placeholder="000.000.000-00" required>

                                                    @error('cpf')
                                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="data_de_nascimento" class="form-label">Data de nascimento <span style="color: red;">*</span></label>
                                                    <input value="{{old('data_de_nascimento')}}" id="data_de_nascimento" name="data_de_nascimento" type="date" class="form-control @error('data_de_nascimento') is-invalid @enderror date-picker" required>
                                                
                                                    @error('data_de_nascimento')
                                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="sexo" class="form-label">Sexo <span style="color: red;">*</span></label>
                                                    <select id="sexo" name="sexo" class="form-select @error('sexo') is-invalid @enderror" required>
                                                        <option selected disabled>selecione</option>
                                                        <option @if(old('sexo') == \App\Models\User::SEXO_ENUM['feminine']) selected @endif value="{{\App\Models\User::SEXO_ENUM['feminine']}}">Feminino</option>
                                                        <option @if(old('sexo') == \App\Models\User::SEXO_ENUM['masculine']) selected @endif value="{{\App\Models\User::SEXO_ENUM['masculine']}}">Masculino</option>
                                                    </select>

                                                    @error('sexo')
                                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="password" class="form-label">Senha <span style="color: red;">*</span></label>
                                                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                                                    
                                                    @error('password')
                                                        <div id="validationServer03Feedback" class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <small id="password-minimo"> Deve ter no mínimo 8 caracteres </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="password-confirmation" class="form-label">Confirmar senha <span style="color: red;">*</span></label>
                                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                                                </div>
                                            </div>
                                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="checkbox" name="termos" id="termos" required @if(old('termos')) selected @endif>
                                                        <label for="termos" class="form-label">{!! __('Eu concordo com os :terms_of_service e :privacy_policy', [
                                                                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Termos de Serviço').'</a>',
                                                                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Política de Privacidade').'</a>',
                                                                                            ]) !!}
                                                        </label>
                                                    </div>
                                                </div>      
                                            @endif
                                            <div class="row" style="text-align: right;">
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-success" style="width: 100%;">Cadastrar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="bottom-img" class="col-md-5"></div>
                            <div id="bottom-form" class="col-md-7"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#btn-entrepreneur').on('click', function(){
            $('#btn-investor').removeClass('selected');
            $(this).addClass('selected');
        });

        $('#btn-investor').on('click', function(){
            $('#btn-entrepreneur').removeClass('selected');
            $(this).addClass('selected');
        });

        function alterar_img(path_img, title) {
            value_entrepreneur = "{{\App\Models\User::PROFILE_ENUM['entrepreneur']}}";
            value_investor = "{{\App\Models\User::PROFILE_ENUM['investor']}}";

            input_profile = document.getElementById('profile');
            img_tag = document.getElementById('img-illustrative');
            img_tag.src = path_img;
            div_entrepreneur = document.getElementById('text-entrepreneur');
            div_investor = document.getElementById('text-investor');

            title_entrepreneur = document.getElementById('entrepreneur-registration');
            title_investor = document.getElementById('investor-registration');

            if (title == 'entrepreneur-registration') {
                input_profile.value = value_entrepreneur;
                title_entrepreneur.style.display = 'block';
                div_entrepreneur.style.display = 'block';
                title_investor.style.display = 'none';
                div_investor.style.display = 'none';
            } else {
                input_profile.value = value_investor;
                title_entrepreneur.style.display = 'none';
                div_entrepreneur.style.display = 'none';
                title_investor.style.display = 'block';
                div_investor.style.display = 'block';
            }
        }

        function click_file_input() {
            $('#foto_do_perfil').click();
        }

        function read_image() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("input-profile-photo").src = e.target.result;
                };       
                file.readAsDataURL(this.files[0]);
            }
        }

        document.getElementById("foto_do_perfil").addEventListener("change", read_image, false);
    </script>

    {{-- <x-jet-validation-errors class="mb-4" /> --}}
</x-guest-layout>
