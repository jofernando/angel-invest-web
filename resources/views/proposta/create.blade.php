<x-app-layout>
    <div class="container" style="margin-top: 50px;">
        <div class="card card-feature">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 div-checks">
                        <div class="row mb-4 mt-4" style="text-align: center;">
                            <div class="col-md-12">
                                <a href="{{route('propostas.index', $startup)}}" class="btn btn-success btn-padding border" style="font-size: 22px;"><img src="{{asset('img/back.svg')}}" alt="Icone de voltar" style="padding-right: 10px;"> Voltar</a>
                            </div>  
                        </div>
                        <div class="row">
                            <h4 class="card-title">Adicionando nova proposta para {{$startup->nome}}</h5>
                        </div>
                    </div>
                    <div class="col-md-8 div-form">
                        <form method="POST" action="{{route('propostas.store', $startup)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="container" style="margin-top: 15px; margin-bottom: 15px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2>Informações da proposta</h2>
                                    </div>
                                </div>
                                <div class="row" style="text-align: right;">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-4">
                                        <label><span style="color: red;">*</span> Campo obrigatório</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="titulo" class="form-label ">Título <span style="color: red;">*</span></label>
                                        <input id="titulo" name="título" type="text" class="form-control @error('título') is-invalid @enderror" placeholder="Digite o título da proposta aqui..." required value="{{old('título')}}">
                                    
                                        @error('título')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="descricao" class="form-label">Descrição <span style="color: red;">*</span></label>
                                        <textarea id="descricao" name="descrição" class="form-control @error('descrição') is-invalid @enderror" placeholder="Forneça uma breve descrição da sua proposta..." required>{{old('descrição')}}</textarea>
                                    
                                        @error('descrição')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="photo" class="form-label">Vídeo do pitch <span style="color: red;">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12">
                                                <div class="card card-click" onclick="click_video_input()">
                                                    <div class="card-body">
                                                        <div style="text-align: center;">
                                                            <div id="div-video-preview" style="display: none;">
                                                                <video id="video-preview" controls style="max-width: 100px;">
                                                                    <source src="">
                                                                       Seu navegador não suporta vídeo HTML5.
                                                                </video>
                                                            </div>
                                                            <div id="div-img-video-input"><img id="img-input-video" src="{{asset('img/upload.svg')}}" alt="Imagem de upload de vídeo"></div>
                                                        </div>
                                                        <div>Faça o upload do vídeo</div>
                                                        <small>Tamanho máximo: <span style="color: red;">100 MB</span></small>
                                                    </div>
                                                </div>

                                                @error('vídeo_do_pitch')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div style="display: none;">
                                                <input id="video_input" name="vídeo_do_pitch" type="file" class="form-control @error('vídeo_do_pitch') is-invalid @enderror" accept="video/mp4,video/mkv">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="photo" class="form-label">Thumbnail <span style="color: red;">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-12" onclick="click_file_input()">
                                                <div class="card card-click">
                                                    <div class="card-body">
                                                        <div style="text-align: center;">
                                                            <img id="input-profile-photo-retangular" src="{{asset('img/img.svg')}}" alt="Imagem default perfil" style="width: 100%; height: 100px; max-width: 100%; max-height: 100px;">
                                                        </div>
                                                        <div>Faça o upload da thumbnail</div>
                                                        <small>Tamanho máximo: <span style="color: red;">5 MB</span></small>
                                                    </div>
                                                </div>
                                                @error('thumbnail')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div style="display: none;">
                                                <input id="thumbnail" name="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/png,image/jpg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4" style="text-align: center;">
                                    <div class="col-md-12">
                                        <button class="btn btn-success" style="width: 40%;">Salvar</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
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
    {{-- <div class="container" style="margin-top: 20px;">
        <form method="POST" action="{{route('propostas.store', $startup)}}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" name="título" id="titulo" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="pitch" class="form-label">Vídeo do pitch</label>
                    <input type="file" name="vídeo_do_pitch" id="pitch" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="descrição" id="descricao" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success submit-form-btn">Salvar</button>
                </div>
            </div>
        </form>
    </div> --}}
    <script>
        CKEDITOR.replace( 'descricao' );

        function click_video_input() {
            $('#video_input').click();
        }

        function click_file_input() {
            $('#thumbnail').click();
        }

        function read_video() {
            if (this.files && this.files[0]) {
                var file = this.files[0];
                var blobURL = URL.createObjectURL(file);
                
                document.getElementById("div-video-preview").innerHTML = '<video id="video-preview" controls style="width: 100%; height: 100px; max-width: 100%; max-height: 100px;">'
                                            +'<source src="'+ blobURL +'">'
                                            +'Seu navegador não suporta vídeo HTML5.</video>';
                
                // document.querySelector("#video-preview").play();

                div_img = document.getElementById('div-img-video-input');
                div_video = document.getElementById('div-video-preview');
                div_img.style.display = "none";
                div_video.style.display = "block";
            }
        }

        function read_image() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("input-profile-photo-retangular").src = e.target.result;
                };       
                file.readAsDataURL(this.files[0]);
            }
        }

        document.getElementById("video_input").addEventListener("change", read_video, false);
        document.getElementById("thumbnail").addEventListener("change", read_image, false);
    </script>
</x-app-layout>