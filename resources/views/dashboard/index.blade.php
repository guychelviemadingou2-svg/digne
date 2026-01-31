@extends('layouts.app')

@section('title', 'Tableau de Bord')
@section('header', 'Tableau de Bord')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label"><i class="bi bi-box"></i> Total Produits</div>
            <div class="stat-value">{{ number_format($totalProducts) }}</div>
            <div class="stat-change text-success"><i class="bi bi-arrow-up"></i> 12.5% vs mois dernier</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label"><i class="bi bi-cash"></i> Valeur du Stock</div>
            <div class="stat-value">€{{ number_format($stockValue, 0) }}</div>
            <div class="stat-change text-success"><i class="bi bi-arrow-up"></i> 8.2% vs mois dernier</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label"><i class="bi bi-arrow-left-right"></i> Taux de Rotation</div>
            <div class="stat-value">{{ $totalRotation }}</div>
            <div class="stat-change text-success"><i class="bi bi-arrow-up"></i> 3.1% vs mois dernier</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-label"><i class="bi bi-exclamation-triangle"></i> Alertes Actives</div>
            <div class="stat-value">{{ $activeAlerts }}</div>
            <div class="stat-change text-warning"><i class="bi bi-arrow-up"></i> 15% vs mois dernier</div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="chart-container">
            <h6 class="mb-3"><i class="bi bi-graph-up"></i> Évolution du Stock</h6>
            <p class="text-muted small">Entrées et sorties mensuelles</p>
            <canvas id="evolutionChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="chart-container">
            <h6 class="mb-3"><i class="bi bi-pie-chart"></i> Répartition par Catégorie</h6>
            <p class="text-muted small">Volume de stock par catégorie</p>
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="table-container">
            <h6 class="mb-3"><i class="bi bi-arrow-left-right"></i> Mouvements Récents</h6>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted small">Dernières opérations de stock</span>
                <a href="/movements" class="text-decoration-none">Voir tout →</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Date</th>
                            <th>Utilisateur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentMovements as $movement)
                            <tr>
                                <td>
                                    <small>{{ $movement->product->name }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $movement->type === 'entrée' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $movement->type === 'entrée' ? '+' : '-' }}{{ $movement->quantity }}
                                    </span>
                                </td>
                                <td><small>{{ $movement->created_at->format('d M Y') }}</small></td>
                                <td><small>{{ $movement->user->name }}</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="table-container">
            <h6 class="mb-3"><i class="bi bi-exclamation-triangle"></i> Alertes Récentes</h6>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted small">{{ $activeAlerts }} alertes actives</span>
                <a href="/alerts" class="text-decoration-none">Voir tout →</a>
            </div>
            @foreach ($recentAlerts as $alert)
                <div class="alert alert-badge alert-{{ strpos($alert->type, 'critique') !== false ? 'critique' : 'warning' }} mb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $alert->product->name }}</strong><br>
                        <small>{{ $alert->message }}</small>
                    </div>
                    <small>{{ $alert->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Graphique d'évolution
    const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
    new Chart(evolutionCtx, {
        type: 'line',
        data: {
            labels: @json($evolutionData['months']),
            datasets: [
                {
                    label: 'Entrées',
                    data: @json($evolutionData['entries']),
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    borderWidth: 2,
                    tension: 0.4
                },
                {
                    label: 'Sorties',
                    data: @json($evolutionData['exits']),
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    borderWidth: 2,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Graphique de répartition par catégorie
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: @json($categoryDistribution->pluck('name')),
            datasets: [{
                data: @json($categoryDistribution->pluck('quantity')),
                backgroundColor: [
                    '#667eea',
                    '#764ba2',
                    '#f093fb',
                    '#4facfe',
                    '#00f2fe'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
