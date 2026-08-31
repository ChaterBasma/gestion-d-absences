<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-cover bg-center"
      style="background-image: url('/images/bg-ofppt.jpg');">

<div class="min-h-screen bg-white/80 flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-xl shadow-xl overflow-hidden">

        <!-- Bande noire -->
        <div class="bg-black text-white text-center py-4 uppercase tracking-wider">
            Connexion
        </div>

        <!-- Form -->
        <div class="p-8">
            {{ $slot }}
        </div>
    </div>

</div>

</body>
</html>
