<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

         <!-- Styles -->
         @livewireStyles
        <link rel="stylesheet" href="{{asset('bootstrap-5.1.3/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{asset('bootstrap-5.1.3/js/bootstrap.js')}}"></script>
        <script src="{{asset('jquery/jquery-3.6.min.js')}}"></script>
    </head>
    <body>
        @component('layouts.nav_bar')@endcomponent
        <div id="container-home" class="container">
            <div id="home-box" class="row justify-content-center">
                <div class="col-md-12">
                    <img id="logo-angel-invest" src="{{asset('img/AngelInvest.png')}}" alt="Logo angel invest">
                    <div id="home-text">
                        A AngelInvest é uma startup que visa aproximar investidores-anjo e startups que estão começando no mercado atualmente. Através da nossa plataforma online o dono da startup pode expor seu pitch, plano de negócio, métricas em uma espécie de leilão. Dando a possibilidade do investidor visualizar sua empresa e caso tenha interesse dar um lance. O lance mais alto ao fim do período de exposição pode negociar com o dono da startup.
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container-fluid">
            <div id="row-startups" class="row">
                <div class="col-md-12">
                    <h6>Startups</h6>
                </div>
            </div>
            <div id="row-cards-startups" class="row">
                <div class="col-md-4">
                    <div class="card card-home" style="width: 100%;">
                        <div class="row area-startup">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <span class="span-area-startup" style="color: white;">Software</span>
                            </div>
                        </div>
                        <img src="img/01.png" class="card-img-top" alt="video da startup">
                        <div class="titles-pitch" class="row">
                            <div class="col-md-12">
                                <span class="title-startup">Titulo do pitch</span>
                                <span class="name-startup">Nome da startup</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. <a href="#">Go somewhere</a></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <span class="qtd-investor" style="color: white;">10 Teste</span>
                                </div>
                                <div class="col-md-8"></div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="card card-home" style="width: 100%;">
                        <div class="row area-startup">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <span class="span-area-startup" style="color: white;">Software</span>
                            </div>
                        </div>
                        <img src="img/01.png" class="card-img-top" alt="video da startup">
                        <div class="titles-pitch" class="row">
                            <div class="col-md-12">
                                <span class="title-startup">Titulo do pitch</span>
                                <span class="name-startup">Nome da startup</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. <a href="#">Go somewhere</a></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <span class="qtd-investor" style="color: white;">10 Teste</span>
                                </div>
                                <div class="col-md-8"></div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="card card-home" style="width: 100%;">
                        <div class="row area-startup">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <span class="span-area-startup" style="color: white;">Software</span>
                            </div>
                        </div>
                        <img src="img/01.png" class="card-img-top" alt="video da startup">
                        <div class="titles-pitch" class="row">
                            <div class="col-md-12">
                                <span class="title-startup">Titulo do pitch</span>
                                <span class="name-startup">Nome da startup</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. <a href="#">Go somewhere</a></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <span class="qtd-investor" style="color: white;">10 Teste</span>
                                </div>
                                <div class="col-md-8"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @component('layouts.footer')@endcomponent

        <script>
            $(document).ready(function(){
                categories = document.getElementsByClassName('span-area-startup');
                qtd_investor = document.getElementsByClassName('qtd-investor');
    
                gerar_cores(categories);
                gerar_cores(qtd_investor);
            });
    
            function gerar_cores(html_colletion) {
                for(i = 0; i < html_colletion.length; i++) {
                    html_colletion[i].style.backgroundColor = gerar_cor();
                }
            }
    
            cores = ['#00ffff', '#7fffd4', '#8a2be2', '#a52a2a', '#5f9ea0', '#6495ed', '#008b8b', '#bdb76b', '#ff8c00', 
                     '#483d8b', '#8fbc8f', '#2f4f4f', '#ffd700', '#20b2aa', '#ffa07a', '#87cefa', '#66cdaa', '#9370db', '#3cb371', '#191970'];
            function gerar_cor() {
                return cores[parseInt(Math.random() * cores.length)];
            }
        </script>
    </body>
</html>
