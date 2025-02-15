<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/bootstrap.csss')}}"></link>
    <title>@yield('titulo')</title>
</head>
<body>
  @yield('contenido') 
</body>
<script src="{{asset('js/bootstrap.js')}}"></script>
</html>