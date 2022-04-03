<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles
        <link rel="stylesheet" href="{{ asset('bootstrap-5.1.3/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('bootstrap-5.1.3/js/bootstrap.js') }}"></script>
        <script src="{{ asset('jquery/jquery-3.6.min.js') }}"></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        <script>
            $(document).ready(function () {
                var btn = document.getElementsByClassName("submit-form-btn");
                if(btn.length > 0){
                    $(document).on('submit', 'form', function() {
                        $('button').attr('disabled', 'disabled');
                        for (var i = 0; i < btn.length; i++) {
                        btn[i].textContent = 'Aguarde...';
                        btn[i].style.backgroundColor = btn[i].style.backgroundColor + 'd8';
                    }
                    });
                }
            })
        </script>
    </body>
</html>
