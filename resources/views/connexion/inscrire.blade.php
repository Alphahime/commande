<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-96">
            <h1 class="text-2xl font-bold mb-4">Inscription</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="nom" class="block text-sm font-semibold mb-1">Nom</label>
                    <input id="nom" type="text" class="w-full px-3 py-2 border rounded-md @error('nom') border-red-500 @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                    @error('nom')
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

                <div class="mb-4">
                    <label for="mdp_confirmation" class="block text-sm font-semibold mb-1">Confirmation du mot de passe</label>
                    <input id="mdp_confirmation" type="password" class="w-full px-3 py-2 border rounded-md" name="mdp_confirmation" required>
                </div>

                <!-- D'autres champs du formulaire peuvent être ajoutés ici -->

                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
