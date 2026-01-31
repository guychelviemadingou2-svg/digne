@extends('layouts.app')

@section('title', 'Changer mot de passe')
@section('header', '🔐 Changer mon mot de passe')

@section('content')
<div class="password-container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Formulaire de changement de mot de passe -->
            <div class="form-card">
                <div class="form-header">
                    <h4>Changer votre mot de passe</h4>
                    <p class="form-subtitle">Pour votre sécurité, changez votre mot de passe régulièrement</p>
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

                <form method="POST" action="{{ route('profile.password.update') }}" class="elegant-form">
                    @csrf
                    @method('PUT')

                    <!-- Mot de passe actuel -->
                    <div class="form-group">
                        <label for="current_password" class="form-label">
                            <i class="bi bi-shield-lock"></i> Mot de passe actuel
                        </label>
                        <div class="password-wrapper">
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" 
                                   placeholder="Entrez votre mot de passe actuel" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-helper">Entrez votre mot de passe actuel pour vérifier votre identité</small>
                    </div>

                    <!-- Nouveau mot de passe -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="bi bi-key"></i> Nouveau mot de passe
                        </label>
                        <div class="password-wrapper">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Entrez un nouveau mot de passe" required
                                   oninput="checkPasswordStrength(this.value)">
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                            <span class="strength-text" id="strengthText">Entrez un mot de passe</span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-helper">Minimum 8 caractères. Utilisez majuscules, minuscules, chiffres et symboles</small>
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <i class="bi bi-check2-circle"></i> Confirmer le mot de passe
                        </label>
                        <div class="password-wrapper">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Confirmez votre nouveau mot de passe" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-helper">Doit être identique au mot de passe ci-dessus</small>
                    </div>

                    <!-- Règles de sécurité -->
                    <div class="security-rules">
                        <h6>✓ Critères de sécurité</h6>
                        <ul>
                            <li id="rule-length" class="rule incomplete">Minimum 8 caractères</li>
                            <li id="rule-uppercase" class="rule incomplete">Au moins une majuscule</li>
                            <li id="rule-lowercase" class="rule incomplete">Au moins une minuscule</li>
                            <li id="rule-number" class="rule incomplete">Au moins un chiffre</li>
                        </ul>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="form-actions">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Mettre à jour le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar de conseils -->
        <div class="col-lg-4">
            <div class="tips-card">
                <div class="tips-header">
                    <h5>🔒 Conseils de sécurité</h5>
                </div>

                <div class="tips-list">
                    <div class="tip-item">
                        <span class="tip-number">1</span>
                        <div class="tip-content">
                            <h6>Mot de passe unique</h6>
                            <p>N'utilisez pas le même mot de passe pour plusieurs services</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <span class="tip-number">2</span>
                        <div class="tip-content">
                            <h6>Complexité</h6>
                            <p>Mélangez majuscules, minuscules, chiffres et symboles</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <span class="tip-number">3</span>
                        <div class="tip-content">
                            <h6>Longueur</h6>
                            <p>Plus c'est long, plus c'est sûr (12+ caractères)</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <span class="tip-number">4</span>
                        <div class="tip-content">
                            <h6>Régularité</h6>
                            <p>Changez-le tous les 3 mois</p>
                        </div>
                    </div>

                    <div class="tip-item">
                        <span class="tip-number">5</span>
                        <div class="tip-content">
                            <h6>Stockage</h6>
                            <p>Ne le partagez avec personne et ne l'écrivez nulle part</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .password-container {
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
        margin-bottom: 28px;
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

    .password-wrapper {
        position: relative;
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
        width: 100%;
        padding-right: 45px;
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

    .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #7c3aed;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s ease;
        padding: 6px;
    }

    .password-toggle:hover {
        color: #6d28d9;
        transform: translateY(-50%) scale(1.1);
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

    .password-strength {
        margin-top: 8px;
    }

    .strength-bar {
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .strength-bar::after {
        content: '';
        display: block;
        height: 100%;
        background: linear-gradient(90deg, #dc2626 0%, #f59e0b 50%, #10b981 100%);
        width: 0%;
        transition: width 0.3s ease;
    }

    .strength-text {
        font-size: 12px;
        color: #6b7280;
    }

    .security-rules {
        background: linear-gradient(135deg, #f9f5ff 0%, #f0e9ff 100%);
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #7c3aed;
        margin-bottom: 28px;
    }

    .security-rules h6 {
        color: #2d1b4e;
        font-weight: 700;
        font-size: 13px;
        margin: 0 0 12px 0;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .security-rules ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .rule {
        padding: 8px 0;
        color: #6b7280;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rule::before {
        content: '✓';
        display: inline-block;
        width: 20px;
        height: 20px;
        background: #e5e7eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: #9ca3af;
        flex-shrink: 0;
    }

    .rule.complete {
        color: #10b981;
    }

    .rule.complete::before {
        background: #10b981;
        color: white;
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

    .tips-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
        padding: 24px;
    }

    .tips-header {
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f0e9ff;
    }

    .tips-header h5 {
        color: #2d1b4e;
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .tips-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .tip-item {
        display: flex;
        gap: 12px;
        padding: 12px;
        background: #f9f5ff;
        border-radius: 10px;
        border-left: 4px solid #7c3aed;
    }

    .tip-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
        color: white;
        border-radius: 50%;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    .tip-content h6 {
        color: #2d1b4e;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin: 0 0 4px 0;
    }

    .tip-content p {
        color: #6b7280;
        font-size: 12px;
        margin: 0;
        line-height: 1.4;
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

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        if (field.type === 'password') {
            field.type = 'text';
        } else {
            field.type = 'password';
        }
    }

    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');
        
        // Critères
        const hasLength = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasNumber = /\d/.test(password);

        // Mettre à jour les règles
        document.getElementById('rule-length').classList.toggle('complete', hasLength);
        document.getElementById('rule-uppercase').classList.toggle('complete', hasUppercase);
        document.getElementById('rule-lowercase').classList.toggle('complete', hasLowercase);
        document.getElementById('rule-number').classList.toggle('complete', hasNumber);

        // Calculer la force
        let strength = 0;
        if (hasLength) strength += 25;
        if (hasUppercase) strength += 25;
        if (hasLowercase) strength += 25;
        if (hasNumber) strength += 25;

        // Mettre à jour la barre
        strengthBar.style.width = strength + '%';

        // Texte et couleur
        if (strength === 0) {
            strengthText.textContent = 'Entrez un mot de passe';
            strengthText.style.color = '#6b7280';
        } else if (strength <= 25) {
            strengthText.textContent = 'Très faible';
            strengthText.style.color = '#dc2626';
        } else if (strength <= 50) {
            strengthText.textContent = 'Faible';
            strengthText.style.color = '#f59e0b';
        } else if (strength <= 75) {
            strengthText.textContent = 'Bon';
            strengthText.style.color = '#f59e0b';
        } else {
            strengthText.textContent = 'Très fort';
            strengthText.style.color = '#10b981';
        }
    }
</script>
@endsection
