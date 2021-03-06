<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <!-- jQuery --> 
        <script src="{{asset('js/jquery-3.6.0.js')}}" type="text/javascript"></script>

        <!-- CSS -->
        @yield('styles')

        <!-- JavaScript -->
        @yield('scripts')

        <title>Charts</title>
    </head>
    <body class="bg-dark">
        <div class="container">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="text-muted text-center">
            <hr>
            <img src="{{ asset('img/developer.jpg') }}" alt="Rafael Rocha" class="rounded-circle" width="80" height="80">
            <h6>Desenvolvido por Rafael Rocha</h6>
            <p>Siga-me no <a href="https://www.linkedin.com/in/rpenido19/" target="_blank" class="text-decoration-none">linkedin</a></p>
        </footer>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    </body>
</html>
