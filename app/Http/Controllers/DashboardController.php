<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Alert;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $stockValue = Product::sum(DB::raw('quantity * price'));
        $totalRotation = StockMovement::count();
        $activeAlerts = Alert::where('resolved', false)->count();

        // Récents mouvements
        $recentMovements = StockMovement::with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Alertes récentes
        $recentAlerts = Alert::with('product')
            ->where('resolved', false)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Données pour le graphique d'évolution
        $evolutionData = $this->getEvolutionData();

        // Données pour la répartition par catégorie
        $categoryDistribution = $this->getCategoryDistribution();

        return view('dashboard.index', compact(
            'totalProducts',
            'stockValue',
            'totalRotation',
            'activeAlerts',
            'recentMovements',
            'recentAlerts',
            'evolutionData',
            'categoryDistribution'
        ));
    }

    private function getEvolutionData()
    {
        $months = [];
        $entries = [];
        $exits = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');

            $entry = StockMovement::where('type', 'entrée')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('quantity');

            $exit = StockMovement::where('type', 'sortie')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('quantity');

            $entries[] = $entry;
            $exits[] = $exit;
        }

        return compact('months', 'entries', 'exits');
    }

    private function getCategoryDistribution()
    {
        return \App\Models\Category::with('products')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'quantity' => $category->products->sum('quantity')
                ];
            });
    }
}
