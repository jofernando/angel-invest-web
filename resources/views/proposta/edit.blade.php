<x-app-layout>
    <div class="container" style="margin-top: 50px;">
        <div class="card card-feature">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 div-checks">
                        <div class="row mb-4 mt-4" style="text-align: center;">
                            <div class="col-md-12">
                                <a href="{{route('propostas.index', $startup)}}" class="btn btn-success btn-padding border"><img src="{{asset('img/back.svg')}}" alt="Icone de voltar" style="padding-right: 5px; height: 22px;"> Voltar</a>
                            </div>  
                        </div>
                        <div class="row">
                            <h4 class="card-title" style="font-size: 22px;">Editando a proposta {{$proposta->titulo}}</h5>
                        </div>
                    </div>
                    <div class="col-md-8 div-form">
                        <form method="POST" action="{{route('propostas.update', ['startup' => $startup, 'proposta' => $proposta])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                        <input id="titulo" name="título" type="text" class="form-control @error('título') is-invalid @enderror" placeholder="Digite o título da proposta aqui..." required value="{{old('título', $proposta->titulo)}}">
                                    
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
                                        <textarea id="descricao" name="descrição" class="form-control @error('descrição') is-invalid @enderror" placeholder="Forneça uma breve descrição da sua proposta..." required>{{old('descrição', $proposta->descricao)}}</textarea>
                                    
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
                                                            <div id="div-img-video-input">
                                                                <video id="video-preview" controls style="width: 100%; height: 100px; max-width: 100%; max-height: 100px;">
                                                                    <source src="{{asset('storage/'.$proposta->video_caminho)}}" type="video/mp4">
                                                                    <source src="{{asset('storage/'.$proposta->video_caminho)}}" type="video/mkv">
                                                                </video>
                                                            </div>
                                                        </div>
                                                        <div>Faça o upload de um novo vídeo para alterar</div>
                                                        <small>Tamanho máximo: <span style="color: red;">100 MB</span></small>
                                                    </div>
                                                </div>
                                                <br>
                                                <div id="pitch-mesage" class="alert alert-danger" role="alert" style="display: @error('vídeo_do_pitch') block @else none @enderror">
                                                    @error('vídeo_do_pitch')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
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
                                                            <img id="input-profile-photo-retangular" src="{{asset('storage/'.$proposta->thumbnail_caminho)}}" alt="Imagem default perfil" style="width: 100%; height: 100px; max-width: 100%; max-height: 100px;">
                                                        </div>
                                                        <div>Faça o upload de uma nova imagem para alterar</div>
                                                        <small>Tamanho máximo: <span style="color: red;">5 MB</span></small>
                                                    </div>
                                                </div>
                                                <br>
                                                <div id="thumbnail-mesage" class="alert alert-danger" role="alert" style="display: @error('thumbnail') block @else none @enderror">
                                                    @error('thumbnail')   
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                            <div style="display: none;">
                                                <input id="thumbnail" name="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/png,image/jpg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4" style="text-align: center;">
                                    <div class="col-md-12">
                                        <button id="salvar" class="btn btn-success submit-form-btn" style="width: 40%;">Salvar</button>
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
                var ptich_mesage = document.getElementById('pitch-mesage');
                
                if (file.size > 104857600) { 
                    ptich_mesage.style.display = "block";
                    ptich_mesage.innerHTML = "O campo thumbnail não pode ser superior a 1024000 kilobytes."
                } else {
                    var blobURL = URL.createObjectURL(file);
                    ptich_mesage.style.display = "none";
                    document.getElementById("div-video-preview").innerHTML = '<video id="video-preview" controls style="width: 100%; height: 100px; max-width: 100%; max-height: 100px;">'
                                            +'<source src="'+ blobURL +'">'
                                            +'Seu navegador não suporta vídeo HTML5.</video>';
                

                    div_img = document.getElementById('div-img-video-input');
                    div_video = document.getElementById('div-video-preview');
                    div_img.style.display = "none";
                    div_video.style.display = "block";
                }
            }
        }

        function read_image() {
            if (this.files && this.files[0]) {
                var ptich_mesage = document.getElementById('thumbnail-mesage');

                if (this.files[0].size > 5242880) { 
                    ptich_mesage.style.display = "block";
                    ptich_mesage.innerHTML = "O campo thumbnail não pode ser superior a 5120 kilobytes."
                } else {
                    var file = new FileReader();
                    ptich_mesage.style.display = "none";

                    file.onload = function(e) {
                        document.getElementById("input-profile-photo-retangular").src = e.target.result;
                    };       
                    file.readAsDataURL(this.files[0]);
                }
                
            }
        }

        document.getElementById("video_input").addEventListener("change", read_video, false);
        document.getElementById("thumbnail").addEventListener("change", read_image, false);
    </script>
</x-app-layout>