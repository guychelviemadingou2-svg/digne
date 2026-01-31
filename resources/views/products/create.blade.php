@extends('layouts.app')

@section('title', 'Créer un Produit')
@section('header', 'Nouveau Produit')

@section('content')
<style>
  body {
    --violet-primary: #8b5cf6;
    --violet-dark: #6d28d9;
    --violet-light: #c4b5fd;
  }
  
  .form-wrapper {
    position: relative;
    min-height: 100vh;
    padding: 40px 20px;
    background: linear-gradient(180deg, rgba(139, 92, 246, 0.03), rgba(107, 40, 217, 0.02));
  }

  /* Éléments décoratifs animés */
  .form-wrapper::before {
    content: '';
    position: fixed;
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.1), transparent);
    border-radius: 50%;
    pointer-events: none;
    z-index: 1;
    animation: float 15s ease-in-out infinite;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(50px); }
  }

  .form-container {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
  }

  .form-header {
    text-align: center;
    margin-bottom: 36px;
  }

  .form-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    color: #fff;
    margin: 0;
    background: linear-gradient(135deg, #8b5cf6, #c4b5fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .form-header p {
    color: rgba(255, 255, 255, 0.7);
    margin: 8px 0 0;
    font-size: 14px;
  }

  .form-card {
    background: linear-gradient(180deg, rgba(139, 92, 246, 0.08), rgba(107, 40, 217, 0.05));
    border-radius: 16px;
    padding: 36px;
    border: 1.5px solid rgba(196, 181, 253, 0.2);
    backdrop-filter: blur(8px);
    box-shadow: 0 20px 60px rgba(139, 92, 246, 0.15);
  }

  .form-section {
    margin-bottom: 32px;
  }

  .form-section:last-of-type {
    margin-bottom: 24px;
  }

  .section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid rgba(196, 181, 253, 0.3);
  }

  .section-icon {
    font-size: 20px;
  }

  .section-header h3 {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #c4b5fd;
    margin: 0;
  }

  .form-group {
    margin-bottom: 18px;
  }

  .form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #fff;
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .form-label .icon {
    color: #c4b5fd;
    font-size: 16px;
  }

  .form-control {
    width: 100%;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.03);
    border: 2px solid rgba(196, 181, 253, 0.2);
    color: #fff;
    padding: 14px 16px;
    font-size: 14px;
    transition: all 0.3s ease;
    font-family: 'Inter', sans-serif;
  }

  .form-control::placeholder {
    color: rgba(255, 255, 255, 0.4);
  }

  .form-control:focus {
    border-color: #8b5cf6;
    background: rgba(255, 255, 255, 0.05);
    box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
    outline: none;
  }

  .form-control:hover:not(:focus) {
    border-color: rgba(196, 181, 253, 0.4);
  }

  .row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  @media(max-width: 600px) {
    .row-2 {
      grid-template-columns: 1fr;
    }
  }

  textarea.form-control {
    resize: vertical;
    min-height: 100px;
  }

  .invalid-feedback {
    color: #fca5a5;
    font-size: 12px;
    margin-top: 6px;
    display: block;
  }

  .btn-group {
    display: flex;
    gap: 14px;
    margin-top: 40px;
  }

  .btn-submit {
    flex: 1;
    background: linear-gradient(135deg, #8b5cf6, #6d28d9);
    border: none;
    border-radius: 12px;
    padding: 14px 28px;
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
  }

  .btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(139, 92, 246, 0.4);
  }

  .btn-submit:active {
    transform: translateY(-1px);
  }

  .btn-cancel {
    background: transparent;
    border: 2px solid rgba(196, 181, 253, 0.3);
    border-radius: 12px;
    padding: 14px 28px;
    color: #c4b5fd;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .btn-cancel:hover {
    background: rgba(196, 181, 253, 0.1);
    border-color: #c4b5fd;
    color: #fff;
  }
</style>

<div class="form-wrapper">
  <div class="form-container">
    <div class="form-header">
      <h1>✨ Créer un Produit</h1>
      <p>Ajouter un nouveau produit à votre inventaire</p>
    </div>

    <div class="form-card">
      <form method="POST" action="/products">
        @csrf

        <!-- Section Infos Générales -->
        <div class="form-section">
          <div class="section-header">
            <span class="section-icon">📝</span>
            <h3>Informations Générales</h3>
          </div>
          
          <div class="form-group">
            <label for="name" class="form-label">
              <span class="icon">📦</span> Nom du Produit
            </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ex: Laptop Dell XPS 13" value="{{ old('name') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="description" class="form-label">
              <span class="icon">📄</span> Description
            </label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Détails supplémentaires sur ce produit...">{{ old('description') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="category_id" class="form-label">
              <span class="icon">🏷️</span> Catégorie
            </label>
            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
              <option value="">Sélectionner une catégorie</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <!-- Section Stock & Prix -->
        <div class="form-section">
          <div class="section-header">
            <span class="section-icon">💰</span>
            <h3>Stock & Tarification</h3>
          </div>
          
          <div class="row-2">
            <div class="form-group">
              <label for="price" class="form-label">
                <span class="icon">💶</span> Prix (€)
              </label>
              <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="0.00" value="{{ old('price') }}" required>
              @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
              <label for="quantity" class="form-label">
                <span class="icon">📊</span> Quantité Initiale
              </label>
              <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="0" value="{{ old('quantity', 0) }}" required>
              @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="row-2">
            <div class="form-group">
              <label for="minimum_quantity" class="form-label">
                <span class="icon">⚠️</span> Seuil Minimum
              </label>
              <input type="number" class="form-control @error('minimum_quantity') is-invalid @enderror" id="minimum_quantity" name="minimum_quantity" placeholder="10" value="{{ old('minimum_quantity', 10) }}" required>
              @error('minimum_quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
              <label for="expiry_date" class="form-label">
                <span class="icon">📅</span> Date d'Expiration
              </label>
              <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
              @error('expiry_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>
        </div>

        <!-- Actions -->
        <div class="btn-group">
          <button type="submit" class="btn-submit">
            ✓ Créer le Produit
          </button>
          <a href="/products" class="btn-cancel">
            Annuler
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection


