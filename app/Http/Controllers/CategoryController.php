<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->paginate(15);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);
        return redirect('/categories')->with('success', 'Catégorie créée');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);
        return redirect('/categories')->with('success', 'Catégorie mise à jour');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect('/categories')->with('error', 'Impossible de supprimer une catégorie avec des produits');
        }
        $category->delete();
        return redirect('/categories')->with('success', 'Catégorie supprimée');
    }
}
