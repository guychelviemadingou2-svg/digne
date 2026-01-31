<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Exports\MovementsExport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ExportController extends Controller
{
    /**
     * Exporter l'état de stock en Excel/CSV
     */
    public function exportStockExcel()
    {
        $products = Product::with('category')->get();

        // If Maatwebsite\Excel is available, deliver a real XLSX file, otherwise fallback to CSV
        try {
            return Excel::download(new ProductsExport($products), 'stock_' . date('Y-m-d_H-i-s') . '.xlsx');
        } catch (\Throwable $e) {
            // Fallback CSV
            $csv = "Nom Produit,Catégorie,Prix,Quantité,Seuil Minimum,Stock Critique\n";
            foreach ($products as $product) {
                $isCritical = $product->quantity <= $product->minimum_quantity ? 'OUI' : 'NON';
                $cat = optional($product->category)->name;
                $csv .= "\"{$product->name}\",\"{$cat}\",{$product->price},{$product->quantity},{$product->minimum_quantity},{$isCritical}\n";
            }

            return response($csv, 200, [
                'Content-Type' => 'text/csv; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="stock_' . date('Y-m-d_H-i-s') . '.csv"',
            ]);
        }
    }

    /**
     * Exporter les mouvements en Excel/CSV
     */
    public function exportMovementsExcel()
    {
        $movements = StockMovement::with('product')
            ->orderBy('created_at', 'desc')
            ->get();
        try {
            return Excel::download(new MovementsExport($movements), 'mouvements_' . date('Y-m-d_H-i-s') . '.xlsx');
        } catch (\Throwable $e) {
            $csv = "Date,Produit,Type,Quantité,Notes\n";
            foreach ($movements as $movement) {
                $date = $movement->created_at->format('Y-m-d H:i:s');
                $prod = optional($movement->product)->name;
                $notes = str_replace(['\n','\r'], [' ', ' '], $movement->notes);
                $csv .= "\"{$date}\",\"{$prod}\",{$movement->type},{$movement->quantity},\"{$notes}\"\n";
            }

            return response($csv, 200, [
                'Content-Type' => 'text/csv; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="mouvements_' . date('Y-m-d_H-i-s') . '.csv"',
            ]);
        }
    }

    /**
     * Télécharger le rapport en PDF (fichier .pdf)
     */
    public function exportReportPdfDownload()
    {
        $products = Product::with('category')->get();
        $totalValue = $products->sum(fn($p) => $p->price * $p->quantity);
        $criticalCount = $products->filter(fn($p) => $p->quantity <= $p->minimum_quantity)->count();

        $html = $this->generatePdfReport($products, $totalValue, $criticalCount);

        try {
            $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait');
            return $pdf->download('rapport_stock_' . date('Y-m-d_H-i-s') . '.pdf');
        } catch (\Throwable $e) {
            // Fallback to inline HTML view
            return response($html, 200, [
                'Content-Type' => 'text/html; charset=utf-8',
                'Content-Disposition' => 'inline; filename="rapport_stock.html"',
            ]);
        }
    }

    /**
     * Exporter rapport HTML imprimable en PDF
     */
    public function exportReportPdf()
    {
        $products = Product::with('category')->get();
        $totalValue = $products->sum(fn($p) => $p->price * $p->quantity);
        $criticalCount = $products->filter(fn($p) => $p->quantity <= $p->minimum_quantity)->count();

        $html = $this->generatePdfReport($products, $totalValue, $criticalCount);

        return response($html, 200, [
            'Content-Type' => 'text/html; charset=utf-8',
            'Content-Disposition' => 'inline; filename="rapport_stock.html"',
        ]);
    }

    /**
     * Générer HTML rapport imprimable
     */
    private function generatePdfReport($products, $totalValue, $criticalCount)
    {
        $date = date('d/m/Y H:i:s');
        $user = Auth::user();
        
        $rows = '';
        foreach ($products as $product) {
            $value = $product->price * $product->quantity;
            $isCritical = $product->quantity <= $product->minimum_quantity;
            $status = $isCritical ? '<span style="color: #ef4444; font-weight: bold;">⚠️ Critique</span>' : '✅ Normal';

            $priceFormatted = number_format($product->price, 2, '.', ',');
            $valueFormatted = number_format($value, 2, '.', ',');

            $rows .= <<<HTML
            <tr>
                <td>{$product->name}</td>
                <td>{$product->category->name}</td>
                <td>€{$priceFormatted}</td>
                <td>{$product->quantity}</td>
                <td>€{$valueFormatted}</td>
                <td>{$status}</td>
            </tr>
HTML;
        }

        $totalValueFormatted = number_format($totalValue, 2, '.', ',');

        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport StockPro</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #333; background: #fafafa; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 40px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 40px; border-bottom: 3px solid #8b5cf6; padding-bottom: 20px; }
        h1 { color: #8b5cf6; margin: 0; font-size: 32px; }
        .meta { color: #666; font-size: 13px; margin-top: 10px; }
        .stats { display: flex; gap: 20px; margin: 30px 0; flex-wrap: wrap; }
        .stat { flex: 1; min-width: 180px; padding: 20px; border: 2px solid #8b5cf6; border-radius: 8px; background: #f9f5ff; }
        .stat-value { font-size: 28px; font-weight: bold; color: #8b5cf6; }
        .stat-label { font-size: 12px; color: #666; margin-top: 5px; text-transform: uppercase; }
        h2 { color: #8b5cf6; margin-top: 40px; font-size: 18px; border-bottom: 2px solid #c4b5fd; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #8b5cf6; color: white; padding: 12px; text-align: left; font-weight: 600; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f9f5ff; }
        .footer { margin-top: 40px; padding-top: 20px; border-top: 2px solid #ddd; font-size: 12px; color: #999; text-align: center; }
        @media print {
            body { background: white; margin: 0; }
            .container { box-shadow: none; }
            .footer { display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Rapport de Stock StockPro</h1>
            <div class="meta">
                <p>📅 Généré le: <strong>{$date}</strong></p>
                <p>👤 Par: <strong>{$user->name}</strong> ({$user->email})</p>
            </div>
        </div>

        <div class="stats">
            <div class="stat">
                <div class="stat-value">{$products->count()}</div>
                <div class="stat-label">Produits Total</div>
            </div>
            <div class="stat">
                <div class="stat-value">€{$totalValueFormatted}</div>
                <div class="stat-label">Valeur Stock</div>
            </div>
            <div class="stat">
                <div class="stat-value">{$products->sum('quantity')}</div>
                <div class="stat-label">Unités Total</div>
            </div>
            <div class="stat">
                <div class="stat-value" style="color: #ef4444;">{$criticalCount}</div>
                <div class="stat-label">Stock Critique</div>
            </div>
        </div>

        <h2>📦 Détail des Produits</h2>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Valeur Totale</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                {$rows}
            </tbody>
        </table>

        <div class="footer">
            <p>Pour imprimer en PDF, utilisez Ctrl+P ou Cmd+P dans votre navigateur.</p>
        </div>
    </div>
</body>
</html>
HTML;
    }

    /**
     * API — Exporter stock en JSON
     */
    public function apiExportStock()
    {
        $products = Product::with('category')->get();

        return response()->json([
            'status' => 'success',
            'type' => 'stock',
            'data' => $products->map(fn($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'category' => $p->category->name,
                'price' => (float) $p->price,
                'quantity' => (int) $p->quantity,
                'minimum' => (int) $p->minimum_quantity,
                'value' => (float) ($p->price * $p->quantity),
                'critical' => $p->quantity <= $p->minimum_quantity,
            ]),
            'meta' => [
                'total_products' => $products->count(),
                'total_value' => (float) $products->sum(fn($p) => $p->price * $p->quantity),
                'total_quantity' => (int) $products->sum('quantity'),
                'exported_at' => now(),
            ]
        ]);
    }

    /**
     * API — Exporter mouvements en JSON
     */
    public function apiExportMovements()
    {
        $movements = StockMovement::with('product', 'user')
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();

        return response()->json([
            'status' => 'success',
            'type' => 'movements',
            'data' => $movements->map(fn($m) => [
                'id' => $m->id,
                'product_id' => $m->product_id,
                'product' => $m->product->name,
                'type' => $m->type,
                'quantity' => (int) $m->quantity,
                'notes' => $m->notes,
                'user_id' => $m->user_id,
                'user' => $m->user->name,
                'created_at' => $m->created_at,
            ]),
            'meta' => [
                'total_records' => $movements->count(),
                'limit' => 100,
                'exported_at' => now(),
            ]
        ]);
    }
}
