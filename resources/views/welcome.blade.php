<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BI Pocket - Page d'accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-['Inter']">

    <!-- HEADER -->
    <header class="bg-white shadow-md py-4 px-6 flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0">
        <h1 class="text-2xl font-bold text-indigo-600">BI Pocket</h1>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline text-center">Se connecter</a>
            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition text-center">
                Créer un compte entreprise
            </a>
        </div>
    </header>

    <!-- MAIN -->
    <main class="flex flex-col items-center text-center px-6 mt-12 sm:mt-16">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4 leading-tight">
            Simplifiez la gestion de votre commerce
        </h2>

        <p class="text-base sm:text-lg text-gray-700 max-w-xl mb-8">
            BI Pocket est une solution intuitive de gestion commerciale pensée pour les
            <strong>petits commerces africains</strong>. Gérez vos produits, ventes, clients et stocks, où que vous soyez.
        </p>

        <img src="https://img.freepik.com/free-vector/business-intelligence-concept-illustration_114360-9173.jpg"
             alt="Illustration BI"
             class="w-full max-w-2xl rounded shadow-md mb-8 object-cover">

        <a href="{{ route('register') }}"
           class="bg-indigo-600 text-white text-base sm:text-lg font-semibold px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
            Commencer maintenant
        </a>
    </main>

    <!-- FOOTER -->
    <footer class="mt-12 sm:mt-16 text-center text-sm text-gray-500 py-6">
        &copy; {{ date('Y') }} BI Pocket. Tous droits réservés.
    </footer>
    
</body>
</html>
