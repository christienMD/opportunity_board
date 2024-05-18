<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
    <title>Opportunity Board</title>
</head>
<body>
   @yield('header')
   @yield('hero')
   @yield('main')
   @include('components.toast_')
</body>
</html>