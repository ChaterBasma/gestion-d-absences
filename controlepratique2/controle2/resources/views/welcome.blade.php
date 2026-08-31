<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GestAbsence</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-cover bg-center"
      style="background-image: url('/images/bg-ofppt.jpg');">

    <!-- Overlay -->
    <div class="min-h-screen bg-white/80 flex flex-col">

        <!-- Header -->
        <header class="flex justify-between items-center px-10 py-6">
            <div class="font-bold text-xl">OFPPT</div>
            <div class="font-bold text-xl text-green-600">GestAbsence</div>
        </header>

        <!-- Card -->
        <main class="flex-1 flex items-center justify-center">
            <div class="bg-white w-full max-w-xl rounded-xl shadow-xl p-10 text-center">

                <!-- Bande noire -->
                <div class="bg-black text-white py-3 rounded mb-6 uppercase tracking-wider">
                    Système de gestion des absences
                </div>

                <p class="text-gray-600 mb-8">
                    Plateforme de suivi et de gestion des absences
                </p>

                <div class="flex justify-center gap-4">
                    <a href="/login"
                       class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">
                        Connexion
                    </a>

                    <a href="/register"
                       class="px-6 py-2 border border-gray-400 rounded hover:bg-gray-100 transition">
                        Inscription
                    </a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="text-center py-4 text-gray-500 text-sm">
            © 2026 OFPPT - GestAbsence
        </footer>
    </div>

</body>
</html>
