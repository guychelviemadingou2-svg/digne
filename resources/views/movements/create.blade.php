@extends('layouts.app')

@section('title', 'Nouveau Mouvement')
@section('header', 'Enregistrer un Mouvement')

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

  .type-info {
    padding: 16px;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(107, 40, 217, 0.08));
    border: 1.5px solid rgba(196, 181, 253, 0.3);
    margin: 16px 0;
    display: none;
    color: rgba(255, 255, 255, 0.85);
    font-size: 13px;
    line-height: 1.6;
  }

  .type-info strong {
    color: #c4b5fd;
    display: block;
    margin-bottom: 4px;
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
      <h1>📤 Enregistrer un Mouvement</h1>
      <p>Ajouter une entrée ou sortie de stock</p>
    </div>

    <div class="form-card">
      <form method="POST" action="/movements">
        @csrf

        <!-- Section Sélection Produit & Type -->
        <div class="form-section">
          <div class="section-header">
            <span class="section-icon">🎯</span>
            <h3>Détails du Mouvement</h3>
          </div>
          
          <div class="form-group">
            <label for="product_id" class="form-label">
              <span class="icon">📦</span> Sélectionner Produit
            </label>
            <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
              <option value="">Choisir un produit...</option>
              @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                  {{ $product->name }} (Stock actuel: {{ $product->quantity }})
                </option>
              @endforeach
            </select>
            @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="type" class="form-label">
              <span class="icon">↔️</span> Type de Mouvement
            </label>
            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required onchange="updateTypeDisplay()">
              <option value="">Choisir un type...</option>
              <option value="entrée" {{ old('type') === 'entrée' ? 'selected' : '' }}>📥 Entrée (Stock reçu)</option>
              <option value="sortie" {{ old('type') === 'sortie' ? 'selected' : '' }}>📤 Sortie (Stock cédé)</option>
            </select>
            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div id="type-info" class="type-info">
            <div id="type-info-text"></div>
          </div>
        </div>

        <!-- Section Quantité & Notes -->
        <div class="form-section">
          <div class="section-header">
            <span class="section-icon">📋</span>
            <h3>Informations Supplémentaires</h3>
          </div>
          
          <div class="form-group">
            <label for="quantity" class="form-label">
              <span class="icon">📊</span> Quantité
            </label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="Nombre d'unités" value="{{ old('quantity') }}" required min="1">
            @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="notes" class="form-label">
              <span class="icon">📝</span> Notes & Observations
            </label>
            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" placeholder="Détails supplémentaires sur ce mouvement...">{{ old('notes') }}</textarea>
            @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <!-- Actions -->
        <div class="btn-group">
          <button type="submit" class="btn-submit">
            ✓ Enregistrer Mouvement
          </button>
          <a href="/movements" class="btn-cancel">
            Annuler
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function updateTypeDisplay() {
    const type = document.getElementById('type').value;
    const info = document.getElementById('type-info');
    const text = document.getElementById('type-info-text');
    
    if (type === 'entrée') {
      text.innerHTML = '<strong>📥 Entrée</strong> Augmente le stock. Réception de produits, retours clients, ajustement d\'inventaire.';
      info.style.display = 'block';
    } else if (type === 'sortie') {
      text.innerHTML = '<strong>📤 Sortie</strong> Diminue le stock. Vente, don, destruction, ajustement négatif.';
      info.style.display = 'block';
    } else {
      info.style.display = 'none';
    }
  }
  
  // Initialiser au chargement
  document.addEventListener('DOMContentLoaded', updateTypeDisplay);
</script>
@endsection


