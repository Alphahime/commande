<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white flex items-center justify-between p-4">
        <div class="flex items-center">
            <img src="file:///home/alpha/Images/logo_kane&frere.png" alt="Logo" class="h-8 mr-2">
            <h1 class="text-lg font-semibold">Kane & Frères</h1>
        </div>
        <div class="flex items-center">
            <a href="#" class="text-gray-300 hover:text-white mr-4">Accueil</a>
            <a href="#" class="text-gray-300 hover:text-white mr-4">Produits</a>
            <!-- Dropdown pour les catégories -->
            <div class="relative inline-block text-left">
                <div>
                    <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-gray-700 text-sm font-medium text-white hover:bg-gray-600" id="categories-menu" aria-haspopup="true" aria-expanded="true">
                        Catégories
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="categories-menu">
                        @foreach ($categories as $categorie)
                            <a href="{{ route('produits.parCategorie', $categorie->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">{{ $categorie->nom }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Autres liens de navigation -->
            <a href="#" class="text-gray-300 hover:text-white ml-4">Connexion</a>
        </div>
    </nav>

    <!-- Contenu de la page -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Panier</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($produits as $produit)
                <div class="bg-white rounded-lg shadow-lg">
                    <!-- Image du produit -->
                    @if($produit->image)
                        <img src="{{ asset('storage/images/' . $produit->image) }}" alt="Image du produit" class="h-64 w-full object-cover rounded-t-lg">
                    @else
                        <img src="{{ asset('storage/default-image.jpg') }}" alt="Image par défaut" class="h-64 w-full object-cover rounded-t-lg">
                    @endif
                    
                    <!-- Contenu du produit -->
                    <div class="p-6">
                        <h2 class="text-xl font-semibold">{{ $produit->nom }}</h2>
                        <p class="text-gray-600">{{ $produit->prix }} XOF</p>
                        <p class="text-gray-600">Quantité : {{ $produit->quantite }}</p>
                        <p class="text-gray-600">Total : {{ $produit->prix * $produit->quantite }} XOF</p>
                        
                        <!-- Bouton Voir Détails -->
                        <a href="{{ route('details', $produit->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 mt-2 inline-block">Voir détails</a>
                    </div>
                </div>
            @endforeach
        </div>

       
    </div>
</body>
</html>
