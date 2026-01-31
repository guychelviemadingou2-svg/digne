@extends('layouts.app')

@section('title', 'Modifier la Catégorie')
@section('header', 'Modifier: ' . $category->name)

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
        max-width: 600px;
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

    .form-group {
        margin-bottom: 22px;
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

    .btn-group {
        display: flex;
        gap: 14px;
        margin-top: 32px;
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

    .info-box {
        padding: 14px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(107, 40, 217, 0.08));
        border: 1.5px solid rgba(196, 181, 253, 0.3);
        color: rgba(255, 255, 255, 0.85);
        font-size: 13px;
        line-height: 1.6;
        margin-top: 24px;
    }

    .info-box strong {
        color: #c4b5fd;
    }

    .current-info {
        padding: 12px;
        border-radius: 10px;
        background: rgba(16, 185, 129, 0.08);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        margin-bottom: 20px;
    }

    .current-info strong {
        color: #10b981;
    }
</style>

<div class="form-wrapper">
    <div class="form-container">
        <div class="form-header">
            <h1>✏️ Modifier la Catégorie</h1>
            <p>Mettez à jour les informations</p>
        </div>

        <div class="form-card">
            <div class="current-info">
                <strong>📌 Catégorie actuelle:</strong> {{ $category->name }}
            </div>

            <form method="POST" action="/categories/{{ $category->id }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="form-label">
                        <span class="icon">📝</span> Nom de la Catégorie
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ex: Électronique, Vêtements, Alimentation..." value="{{ old('name', $category->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">
                        <span class="icon">📄</span> Description
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Décrivez cette catégorie (couleur, type de produits, etc.)">{{ old('description', $category->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="info-box">
                    <strong>💡 Conseil:</strong> Les modifications seront appliquées à cette catégorie et à tous ses produits associés.
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-submit">
                        ✓ Mettre à jour
                    </button>
                    <a href="/categories" class="btn-cancel">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
