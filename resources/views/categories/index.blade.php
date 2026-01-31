@extends('layouts.app')

@section('title', 'Catégories')
@section('header', 'Catégories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5>Liste des Catégories</h5>
    <a href="/categories/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouvelle Catégorie
    </a>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Produits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>
                            @if ($category->description)
                                {{ Str::limit($category->description, 50) }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $category->products_count }}</span>
                        </td>
                        <td>
                            <a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="/categories/{{ $category->id }}" style="display:inline;">
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
    {{ $categories->links('pagination::bootstrap-5') }}
</div>
@endsection
