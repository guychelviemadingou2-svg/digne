@extends('layouts.app')

@section('title', 'Produits')
@section('header', 'Produits')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5>Liste des Produits</h5>
    <a href="/products/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouveau Produit
    </a>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Min</th>
                    <th>Statut</th>
                    <th>Expiration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td><span class="badge bg-info">{{ $product->category->name }}</span></td>
                        <td>€{{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->minimum_quantity }}</td>
                        <td>
                            @if ($product->quantity == 0)
                                <span class="badge bg-danger">Rupture</span>
                            @elseif ($product->quantity <= $product->minimum_quantity)
                                <span class="badge bg-warning">Critique</span>
                            @else
                                <span class="badge bg-success">Normal</span>
                            @endif
                        </td>
                        <td>
                            @if ($product->expiry_date)
                                {{ $product->expiry_date->format('d/m/Y') }}
                                @if ($product->expiry_date->isPast())
                                    <span class="badge bg-danger">Expiré</span>
                                @elseif ($product->expiry_date->diffInDays(now()) <= 7)
                                    <span class="badge bg-warning">Expire bientôt</span>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="/products/{{ $product->id }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection
