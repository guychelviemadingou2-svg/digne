@extends('layouts.app')

@section('title', 'Mon Profil')
@section('header', '👤 Mon Profil')

@section('content')
<div class="profile-container">
    <div class="row">
        <!-- Carte du Profil -->
        <div class="col-lg-4 mb-4">
            <div class="profile-card">
                <div class="profile-header">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&size=120&background=7c3aed&color=fff" 
                         alt="Avatar" class="profile-avatar">
                    <h3 class="mt-3">{{ auth()->user()->name }}</h3>
                    <p class="text-muted">{{ auth()->user()->email }}</p>
                </div>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-icon">📊</span>
                        <div>
                            <p class="stat-label">Utilisateur depuis</p>
                            <p class="stat-value">{{ auth()->user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-icon">✅</span>
                        <div>
                            <p class="stat-label">Statut</p>
                            <p class="stat-value">Actif</p>
                        </div>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('profile.edit') }}" class="btn btn-edit">
                        <i class="bi bi-pencil"></i> Modifier le profil
                    </a>
                    <a href="{{ route('profile.password') }}" class="btn btn-password">
                        <i class="bi bi-lock"></i> Changer mot de passe
                    </a>
                </div>
            </div>
        </div>

        <!-- Informations Détaillées -->
        <div class="col-lg-8">
            <div class="info-card">
                <div class="info-header">
                    <h4>Informations Personnelles</h4>
                    <span class="badge-info">Lisez-seul</span>
                </div>
                
                <div class="info-grid">
                    <div class="info-item">
                        <label class="info-label">Nom Complet</label>
                        <p class="info-value">{{ auth()->user()->name }}</p>
                    </div>
                    
                    <div class="info-item">
                        <label class="info-label">Email</label>
                        <p class="info-value">{{ auth()->user()->email }}</p>
                    </div>
                    
                    <div class="info-item">
                        <label class="info-label">Créé le</label>
                        <p class="info-value">{{ auth()->user()->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    
                    <div class="info-item">
                        <label class="info-label">Dernière modification</label>
                        <p class="info-value">{{ auth()->user()->updated_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Sécurité -->
            <div class="security-card mt-4">
                <div class="security-header">
                    <h4>Sécurité</h4>
                </div>
                
                <div class="security-items">
                    <div class="security-item">
                        <div class="security-icon">🔐</div>
                        <div class="security-content">
                            <h6>Mot de passe</h6>
                            <p>Changez votre mot de passe régulièrement pour plus de sécurité</p>
                        </div>
                        <a href="{{ route('profile.password') }}" class="btn btn-sm btn-outline-primary">
                            Modifier
                        </a>
                    </div>

                    <div class="security-item">
                        <div class="security-icon">📱</div>
                        <div class="security-content">
                            <h6>Sessions Active</h6>
                            <p>Vous êtes actuellement connecté sur cet appareil</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-container {
        padding: 20px 0;
    }

    .profile-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #2d1b4e 0%, #1a0f2e 100%);
        padding: 40px 20px;
        text-align: center;
        color: white;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .profile-header h3 {
        color: white;
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        margin-top: 15px;
        margin-bottom: 5px;
        font-weight: 700;
    }

    .profile-header .text-muted {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
    }

    .profile-stats {
        padding: 20px;
        border-bottom: 2px solid #f0e9ff;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .stat-item:last-child {
        margin-bottom: 0;
    }

    .stat-icon {
        font-size: 24px;
    }

    .stat-label {
        font-size: 12px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin: 0;
    }

    .stat-value {
        font-size: 14px;
        color: #2d1b4e;
        font-weight: 600;
        margin: 0;
    }

    .profile-actions {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .btn-edit, .btn-password {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-password {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    .btn-password:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
    }

    .info-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
        padding: 28px;
    }

    .info-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f0e9ff;
    }

    .info-header h4 {
        color: #2d1b4e;
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        margin: 0;
    }

    .badge-info {
        background: linear-gradient(135deg, #f0e9ff 0%, #e8d5ff 100%);
        color: #7c3aed;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .info-item {
        padding: 16px;
        background: #f9f5ff;
        border-radius: 12px;
        border-left: 4px solid #7c3aed;
    }

    .info-label {
        display: block;
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .info-value {
        color: #2d1b4e;
        font-size: 15px;
        font-weight: 500;
        margin: 0;
    }

    .security-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(45, 27, 78, 0.08);
        padding: 28px;
    }

    .security-header {
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f0e9ff;
    }

    .security-header h4 {
        color: #2d1b4e;
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        font-weight: 700;
        margin: 0;
    }

    .security-items {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .security-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        background: #f9f5ff;
        border-radius: 12px;
        border-left: 4px solid #06b6d4;
    }

    .security-icon {
        font-size: 28px;
        min-width: 40px;
        text-align: center;
    }

    .security-content {
        flex: 1;
    }

    .security-content h6 {
        color: #2d1b4e;
        font-weight: 700;
        margin: 0 0 4px 0;
        font-size: 14px;
    }

    .security-content p {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .profile-actions {
            flex-direction: row;
        }

        .btn-edit, .btn-password {
            flex: 1;
        }
    }
</style>
@endsection
