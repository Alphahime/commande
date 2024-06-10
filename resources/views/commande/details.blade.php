<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white flex items-center justify-between p-4">
        <div class="flex items-center">
            <img src="/path/to/logo.png" alt="Logo" class="h-8 mr-2">
            <h1 class="text-lg font-semibold">Votre Site</h1>
        </div>
        <div>
            <a href="{{ route('produits.index') }}" class="text-gray-300 hover:text-white mr-4">Accueil</a>
            <a href="{{ route('produits.index') }}" class="text-gray-300 hover:text-white mr-4">Produits</a>
            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white mr-4">Connexion</a>
            <a href="{{ route('register') }}" class="text-gray-300 hover:text-white">Inscription</a>
        </div>
    </nav>

    <!-- Contenu de la page -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Détails du Produit</h1>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Image du produit -->
            @if($produit->image)
                <img src="{{ asset('storage/' . $produit->image) }}" alt="Image du produit" class="h-64 w-full object-cover rounded-t-lg mb-4">
            @else
                <img src="{{ asset('storage/default-image.jpg') }}" alt="Image par défaut" class="h-64 w-full object-cover rounded-t-lg mb-4">
            @endif

            <!-- Détails du produit -->
            <h2 class="text-xl font-semibold">{{ $produit->nom }}</h2>
            <p class="text-gray-600">Prix : {{ $produit->prix }} €</p>
            <p class="text-gray-600">État : {{ $produit->etat }}</p>
            <p class="text-gray-600">Catégorie : {{ $produit->categorie->nom }}</p>
            <p class="text-gray-600 mt-4">{{ $produit->description }}</p>

            <!-- Formulaire de commande -->
            <form action="{{ route('commander') }}" method="POST">
                @csrf
                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 mt-4">Commander</button>
            </form>

            <!-- Boutons de connexion et d'inscription -->
            <div class="mt-8">
                <a href="{{ route('login') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 mt-2 inline-block">Connexion</a>
                <a href="{{ route('register') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 mt-2 inline-block">Inscription</a>
            </div>
        </div>
    </div>
</body>
</html>
