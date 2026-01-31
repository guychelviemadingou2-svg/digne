@extends('layouts.app')

@section('title', 'Alertes')
@section('header', 'Alertes')

@section('content')
<h5 class="mb-4">Toutes les Alertes</h5>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Produit</th>
                    <th>Type</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alerts as $alert)
                    <tr class="{{ $alert->resolved ? 'table-light' : '' }}">
                        <td>
                            <strong>{{ $alert->product->name }}</strong>
                        </td>
                        <td>
                            @php
                                $badgeClass = match($alert->type) {
                                    'stock_critique' => 'bg-danger',
                                    'seuil_minimum' => 'bg-warning',
                                    'expire_bientot' => 'bg-warning',
                                    'rupture_imminente' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                                $label = str_replace('_', ' ', ucfirst($alert->type));
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $label }}</span>
                        </td>
                        <td>{{ $alert->message }}</td>
                        <td>
                            @if ($alert->resolved)
                                <span class="badge bg-success">Résolu</span>
                            @else
                                <span class="badge bg-warning">Actif</span>
                            @endif
                        </td>
                        <td>{{ $alert->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if (!$alert->resolved)
                                <form method="POST" action="/alerts/{{ $alert->id }}/resolve" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="/alerts/{{ $alert->id }}" style="display:inline;">
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
    {{ $alerts->links('pagination::bootstrap-5') }}
</div>
@endsection
