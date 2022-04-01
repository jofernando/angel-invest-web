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
                                <div id="bottom-img-div" class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <img id="img-illustrative" src="img/empreendedor-preto.svg" class="img-fluid rounded-start" alt="Imagem ilustrativa empreendedor">
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
                                                        <div class="input-group mb-3">
                                                            <button id="btn-entrepreneur" class="btn btn-outline-primary" type="button" onclick="alterar_img('img/empreendedor-preto.svg', 'entrepreneur-registration')">Empreendedor</button>
                                                            <button id="btn-investor" class="btn btn-outline-secondary" type="button" onclick="alterar_img('img/investidor-preto.png', 'investor-registration')">Investidor-anjo</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                                Proin sed eleifend risus, ac congue nibh. Pellentesque 
                                                aliquam lobortis erat a elementum.  Nullam hendrerit 
                                                commodo varius.  Etiam purus lacus, rutrum id tellus 
                                                a, vehicula tincidunt dui.  Sed a molestie orci. 
                                                Nunc luctus velit vitae metus molestie malesuada.
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
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <input id="profile" type="hidden" name="profile" value="{{\App\Models\User::PROFILE_ENUM['entrepreneur']}}">
                                            <div class="row mb-3" style="text-align: right;">
                                                <div class="col-md-9"></div>
                                                <div class="col-md-3">
                                                    <label id="label-photo" for="photo" class="form-label">Foto de perfil</label>
                                                    <img id="input-profile-photo" src="img/perfil.svg" alt="Imagem default perfil" onclick="click_file_input()">
                                                    <div style="display: none;">
                                                        <input id="photo" name="photo" type="file" class="form-control" accept="png">
                                                    </div>
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
                                                    <input id="nome" name="nome" type="text" class="form-control" placeholder="Digite seu nome aqui..." required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                                                    <input id="email" name="email" type="email" class="form-control" placeholder="email@gmail.com" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cpf" class="form-label">CPF <span style="color: red;">*</span></label>
                                                    <input id="cpf" name="cpf" type="text" class="form-control" placeholder="000.000.000-00" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="data_de_nascimento" class="form-label">Data de nascimento <span style="color: red;">*</span></label>
                                                    <input id="data_de_nascimento" name="data_de_nascimento" type="date" class="form-control" placeholder="email@gmail.com" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="sexo" class="form-label">Sexo <span style="color: red;">*</span></label>
                                                    <select id="sexo" name="sexo" class="form-select" required>
                                                        <option selected disabled>selecione</option>
                                                        <option value="1">Feminino</option>
                                                        <option value="2">Masculino</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="password" class="form-label">Senha <span style="color: red;">*</span></label>
                                                    <input id="password" name="password" type="password" class="form-control" required>
                                                    <small id="password-minimo"> Deve ter no mínimo 8 caracteres </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="password-confirmation" class="form-label">Confirmar senha <span style="color: red;">*</span></label>
                                                    <input id="password-confirmation" name="password-confirmation" type="password" class="form-control" required>
                                                </div>
                                            </div>
                                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="checkbox" name="terms" id="terms" required>
                                                        <label for="terms" class="form-label">{!! __('Eu concordo com os :terms_of_service e :privacy_policy', [
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
        function alterar_img(path_img, title) {
            value_entrepreneur = "{{\App\Models\User::PROFILE_ENUM['entrepreneur']}}"
            value_investor = "{{\App\Models\User::PROFILE_ENUM['investor']}}"

            input_profile = document.getElementById('profile');
            img_tag = document.getElementById('img-illustrative');
            img_tag.src = path_img;

            title_entrepreneur = document.getElementById('entrepreneur-registration');
            title_investor = document.getElementById('investor-registration');

            if (title == 'entrepreneur-registration') {
                input_profile.value = value_entrepreneur;
                title_entrepreneur.style.display = 'block';
                title_investor.style.display = 'none';
            } else {
                input_profile.value = value_investor;
                title_entrepreneur.style.display = 'none';
                title_investor.style.display = 'block';
            }
        }

        function click_file_input() {
            $('#photo').click();
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

        document.getElementById("photo").addEventListener("change", read_image, false);
    </script>

    {{-- <x-jet-validation-errors class="mb-4" /> --}}
</x-guest-layout>
