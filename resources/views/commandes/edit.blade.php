@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Modifier la Commande</h1>

    <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $commande->client_id ? 'selected' : '' }}>
                        {{ $client->name }} ({{ $client->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <h4>Produits</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="produits-container">
                @foreach ($commande->produits as $produit)
                    <tr>
                        <td>
                            <input type="hidden" name="produits[]" value="{{ $produit->id }}">
                            {{ $produit->nom }}
                        </td>
                        <td>
                            <input type="number" name="quantites[]" class="form-control quantite" 
                                value="{{ $produit->pivot->quantite }}" min="1" required>
                        </td>
                        <td class="prix">{{ number_format($produit->pivot->prix, 2) }} MAD</td>
                        <td class="subtotal">{{ number_format($produit->pivot->quantite * $produit->pivot->prix, 2) }} MAD</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm supprimer-produit">X</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bouton pour ajouter un produit -->
        <button type="button" id="ajouterProduit" class="btn btn-success">Ajouter un produit</button>

        <h3 class="mt-3">Total : <span id="totalCommande">{{ number_format($commande->total, 2) }}</span> MAD</h3>

        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
    </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    let totalCommande = document.getElementById('totalCommande');
    let produitsContainer = document.getElementById('produits-container');
    let ajouterProduitBtn = document.getElementById('ajouterProduit');

    // Fonction pour recalculer le total général
    function recalculerTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(function (cell) {
            let subtotal = parseFloat(cell.innerText.replace(' MAD', '').replace(',', '').trim());
            if (!isNaN(subtotal)) {
                total += subtotal;
            }
        });
        totalCommande.innerText = total.toFixed(2) + " MAD";
    }

    // Recalculer le total lorsqu'on change la quantité
    produitsContainer.addEventListener('input', function (event) {
        if (event.target.classList.contains('quantite')) {
            let row = event.target.closest('tr');
            let quantite = parseFloat(event.target.value);
            let prixUnitaire = parseFloat(row.querySelector('.prix').innerText.replace(' MAD', '').replace(',', '').trim());

            if (!isNaN(quantite) && !isNaN(prixUnitaire)) {
                let subtotal = quantite * prixUnitaire;
                row.querySelector('.subtotal').innerText = subtotal.toFixed(2) + " MAD";
            }

            recalculerTotal();
        }
    });

    // Ajouter un nouveau produit
    ajouterProduitBtn.addEventListener('click', function () {
        let newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="produits[]" class="form-control produit-select">
                    @foreach ($produits as $produit)
                        <option value="{{ $produit->id }}" data-prix="{{ $produit->prix }}">
                            {{ $produit->nom }} ({{ number_format($produit->prix, 2) }} MAD)
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="quantites[]" class="form-control quantite" value="1" min="1" required></td>
            <td class="prix">{{ number_format($produits->first()->prix, 2) }} MAD</td>
            <td class="subtotal">{{ number_format($produits->first()->prix, 2) }} MAD</td>
            <td><button type="button" class="btn btn-danger btn-sm supprimer-produit">X</button></td>
        `;

        produitsContainer.appendChild(newRow);
        recalculerTotal();
    });

    // Supprimer un produit de la commande
    produitsContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('supprimer-produit')) {
            event.target.closest('tr').remove();
            recalculerTotal();
        }
    });

    // Mettre à jour le prix et total lorsque le produit est changé
    produitsContainer.addEventListener('change', function (event) {
        if (event.target.classList.contains('produit-select')) {
            let row = event.target.closest('tr');
            let prixUnitaire = parseFloat(event.target.selectedOptions[0].dataset.prix);
            let quantite = parseInt(row.querySelector('.quantite').value);

            if (!isNaN(prixUnitaire) && !isNaN(quantite)) {
                row.querySelector('.prix').innerText = prixUnitaire.toFixed(2) + " MAD";
                row.querySelector('.subtotal').innerText = (prixUnitaire * quantite).toFixed(2) + " MAD";
            }

            recalculerTotal();
        }
    });
});

</script>
@endsection
