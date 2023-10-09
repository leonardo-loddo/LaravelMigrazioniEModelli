<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Modelli e Migrazioni</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        {{-- Navbar --}}
        <x-navbar />
        {{-- Page Content --}}
        <main class="container min-vh-100">
            {{$slot}}
        </main>
        {{-- Footer --}}
        <x-footer />
    </body>
</html>
