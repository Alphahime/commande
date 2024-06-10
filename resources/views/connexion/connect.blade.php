<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-96">
            <h1 class="text-2xl font-bold mb-4">Connexion</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if(session('produit_id'))
                    <input type="hidden" name="produit_id" value="{{ session('produit_id') }}">
                @endif

                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold mb-1">Nom</label>
                    <input id="name" type="text" class="w-full px-3 py-2 border rounded-md @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="mdp" class="block text-sm font-semibold mb-1">Mot de passe</label>
                    <input id="mdp" type="password" class="w-full px-3 py-2 border rounded-md @error('mdp') border-red-500 @enderror" name="mdp" required>
                    @error('mdp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
