<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{ asset(path: 'css/all.min.css') }}">
    <title>@yield('titulo')</title>
</head>
<body>
  @yield('contenido')
</body>
@yield('footer', View::make('MenuPrincipal.footer'))
<script src="{{asset('js/bootstrap.js')}}"></script>
</html>
