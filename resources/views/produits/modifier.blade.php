<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier un produit</h1>
        <form action="{{ route('produits.mettreAJour', $produit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" class="form-control" value="{{ $produit->nom }}" required>
            </div>
            <div class="form-group">
                <label for="prix">Prix:</label>
                <input type="number" id="prix" name="prix" class="form-control" value="{{ $produit->prix }}" required>
            </div>
            <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <select name="categorieId" id="categorie" class="form-control" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="etat">État:</label>
                <select name="etat" id="etat" class="form-control" required>
                    <option value="disponible" {{ $produit->etat == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="ruptureStock" {{ $produit->etat == 'ruptureStock' ? 'selected' : '' }}>Rupture de stock</option>
                    <option value="enStock" {{ $produit->etat == 'enStock' ? 'selected' : '' }}>En stock</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
