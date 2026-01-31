<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('movements.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entrée,sortie',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        // Mettre à jour la quantité du produit
        $product = Product::find($validated['product_id']);
        if ($validated['type'] === 'entrée') {
            $product->quantity += $validated['quantity'];
        } else {
            if ($product->quantity < $validated['quantity']) {
                return back()->with('error', 'Quantité insuffisante');
            }
            $product->quantity -= $validated['quantity'];
        }
        $product->save();

        StockMovement::create($validated);
        return redirect('/movements')->with('success', 'Mouvement enregistré');
    }
}
