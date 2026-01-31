@extends('layouts.app')

@section('title', 'Modifier mon profil')
@section('header', '✏️ Modifier mon profil')

@section('content')
<div class="edit-profile-container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Formulaire de modification du profil -->
            <div class="form-card">
                <div class="form-header">
                    <h4>Informations Personnelles</h4>
                    <p class="form-subtitle">Mettez à jour vos informations personnelles</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>⚠️ Erreurs détectées:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="elegant-form">
                    @csrf
                    @method('PUT')

                    <!-- Nom Complet -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="bi bi-person"></i> Nom Complet
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', auth()->user()->name) }}" 
                               placeholder="Votre nom complet" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-helper">Entre 2 et 255 caractères</small>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                               placeholder="votre@email.com" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-helper">Une adresse email unique</small>
                    </div>

                    <!-- Téléphone (optionnel) -->
                    <div class="form-group">
                        <label for="phone" class="form-label">
                            <i class="bi bi-telephone"></i> Téléphone
                        </label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" 
                               placeholder="+33 6 12 34 56 78">
                        @error('phone')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-helper">Optionnel - Votre numéro de téléphone</small>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="form-actions">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>

            <!-- Informations supplémentaires -->
            <div class="info-card mt-4">
                <div class="info-header">
                    <h5>💡 Conseil de sécurité</h5>
                </div>
                <p class="info-text">
                    Assurez-vous que votre email est correct et à jour. Vous recevrez les notifications importantes à cet email.
                </p>
            </div>
        </div>

        <!-- Sidebar d'aide -->
        <div class="col-lg-4">
            <div class="help-card">
                <div class="help-header">
                    <h5>❓ Besoin d'aide?</h5>
                </div>

                <div class="help-items">
                    <div class="help-item">
                        <div class="help-icon">📝</div>
                        <div class="help-content">
                            <h6>Nom Complet</h6>
                            <p>Utilisé pour la personnalisation et l'affichage dans l'application.</p>
                        </div>
                    </div>

                    <div class="help-item">
                        <div class="help-icon">✉️</div>
                        <div class="help-content">
                            <h6>Email</h6>
                            <p>Utilisé pour la connexion et les notifications. Doit être unique.</p>
                        </div>
                    </div>

                    <div class="help-item">
                        <div class="help-icon">🔐</div>
                        <div class="help-content">
                            <h6>Sécurité</h6>
                            <p>Changez régulièrement votre mot de passe pour plus de sécurité.</p>
                        </div>
                    </div>

                    <div class="help-item">
                        <div class="help-icon">📞</div>
                        <div class="help-content">
                            <h6>Téléphone</h6>
                            <p>Optionnel. Aide à la récupération de compte et aux notifications.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('profile.password') }}" class="help-link">
                    <i class="bi bi-lock"></i> Changer votre mot de passe
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .edit-profile-container {
        padding: 20px 0;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
        padding: 32px;
    }

    .form-header {
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0e9ff;
    }

    .form-header h4 {
        color: #2d1b4e;
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 8px 0;
    }

    .form-subtitle {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .elegant-form {
        width: 100%;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #2d1b4e;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 10px;
    }

    .form-label i {
        color: #7c3aed;
        font-size: 16px;
    }

    .form-control {
        border-radius: 12px;
        border: 2px solid #f0e9ff;
        padding: 14px 16px;
        font-size: 15px;
        background: #f9f5ff;
        transition: all 0.3s ease;
        color: #2d1b4e;
        font-family: 'Poppins', sans-serif;
    }

    .form-control:focus {
        border-color: #7c3aed;
        background: white;
        box-shadow: 0 0 0 0.3rem rgba(124, 58, 237, 0.1);
        color: #2d1b4e;
    }

    .form-control::placeholder {
        color: #b4a7c8;
    }

    .form-control.is-invalid {
        border-color: #dc2626;
        background: #fde8e8;
    }

    .form-control.is-invalid:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 0.3rem rgba(220, 38, 38, 0.1);
    }

    .invalid-feedback {
        display: block;
        color: #dc2626;
        font-size: 12px;
        margin-top: 6px;
        font-weight: 500;
    }

    .form-helper {
        display: block;
        color: #9ca3af;
        font-size: 12px;
        margin-top: 6px;
        letter-spacing: 0.2px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 20px;
        border-top: 2px solid #f0e9ff;
    }

    .btn-outline-secondary {
        background: white;
        border: 2px solid #e5e7eb;
        color: #6b7280;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-outline-secondary:hover {
        border-color: #7c3aed;
        color: #7c3aed;
        background: #f9f5ff;
    }

    .info-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
        padding: 20px;
        border-left: 4px solid #06b6d4;
    }

    .info-header {
        margin-bottom: 12px;
    }

    .info-header h5 {
        color: #2d1b4e;
        font-size: 14px;
        font-weight: 700;
        margin: 0;
        font-family: 'Playfair Display', serif;
    }

    .info-text {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
        line-height: 1.6;
    }

    .help-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
        padding: 24px;
    }

    .help-header {
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f0e9ff;
    }

    .help-header h5 {
        color: #2d1b4e;
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .help-items {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 20px;
    }

    .help-item {
        display: flex;
        gap: 12px;
        padding: 12px;
        background: #f9f5ff;
        border-radius: 10px;
    }

    .help-icon {
        font-size: 20px;
        min-width: 32px;
        text-align: center;
    }

    .help-content h6 {
        color: #2d1b4e;
        font-weight: 700;
        font-size: 13px;
        margin: 0 0 4px 0;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .help-content p {
        color: #6b7280;
        font-size: 12px;
        margin: 0;
        line-height: 1.5;
    }

    .help-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
        color: white;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .help-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
        color: white;
    }

    .alert {
        border-radius: 12px;
        border-left: 4px solid;
        padding: 16px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background: #fde8e8;
        border-left-color: #dc2626;
        color: #991b1b;
    }

    .alert-success {
        background: #d1fae5;
        border-left-color: #10b981;
        color: #065f46;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-outline-secondary {
            width: 100%;
        }
    }
</style>
@endsection
