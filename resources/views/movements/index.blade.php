@extends('layouts.app')

@section('title', 'Mouvements de Stock')
@section('header', 'Mouvements de Stock')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5>Tous les Mouvements</h5>
    <a href="/movements/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouveau Mouvement
    </a>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Produit</th>
                    <th>Type</th>
                    <th>Quantité</th>
                    <th>Utilisateur</th>
                    <th>Notes</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movements as $movement)
                    <tr>
                        <td>
                            <strong>{{ $movement->product->name }}</strong>
                        </td>
                        <td>
                            <span class="badge {{ $movement->type === 'entrée' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($movement->type) }}
                            </span>
                        </td>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->user->name }}</td>
                        <td>
                            @if ($movement->notes)
                                {{ Str::limit($movement->notes, 30) }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $movements->links('pagination::bootstrap-5') }}
</div>
@endsection
