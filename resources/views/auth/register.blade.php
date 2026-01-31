<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockPro - Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        body {
            background: linear-gradient(135deg, #2d1b4e 0%, #1a0f2e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Coeurs violets flottants en arrière-plan */
        .heart {
            position: absolute;
            font-size: 2rem;
            color: rgba(147, 112, 219, 0.1);
            animation: float 6s ease-in-out infinite;
            pointer-events: none;
        }

        .heart:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; }
        .heart:nth-child(2) { right: 15%; top: 30%; animation-delay: 1s; }
        .heart:nth-child(3) { left: 20%; bottom: 20%; animation-delay: 2s; }
        .heart:nth-child(4) { right: 10%; bottom: 30%; animation-delay: 1.5s; }
        .heart:nth-child(5) { left: 50%; top: 10%; animation-delay: 2.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        .auth-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            gap: 0;
        }

        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            min-height: 600px;
            position: relative;
            overflow: hidden;
        }

        .auth-left::before {
            content: '💜';
            position: absolute;
            font-size: 8rem;
            opacity: 0.15;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .auth-left h2 {
            color: white;
            font-size: 32px;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .auth-left p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .auth-left .heart-emoji {
            font-size: 2.5rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.1); }
            50% { transform: scale(1); }
        }

        .auth-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-height: 600px;
            overflow-y: auto;
        }

        .form-header {
            margin-bottom: 28px;
            text-align: center;
        }

        .form-header h1 {
            color: #2d1b4e;
            font-size: 28px;
            margin-bottom: 12px;
        }

        .form-header p {
            color: #6b7280;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group {
            margin-bottom: 18px;
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
            margin-bottom: 8px;
        }

        .form-label i {
            color: #7c3aed;
            font-size: 16px;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #f0e9ff;
            padding: 12px 14px;
            font-size: 14px;
            background: #f9f5ff;
            transition: all 0.3s ease;
            color: #2d1b4e;
            width: 100%;
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

        .btn-submit {
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            font-size: 14px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            margin-top: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.4);
            color: white;
            text-decoration: none;
            background: linear-gradient(135deg, #6d28d9 0%, #5b21b6 100%);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #f0e9ff;
        }

        .form-footer p {
            color: #6b7280;
            font-size: 13px;
            margin: 0;
        }

        .form-footer a {
            color: #7c3aed;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .form-footer a:hover {
            color: #6d28d9;
            text-decoration: underline;
        }

        .error-message {
            background: #fde8e8;
            color: #991b1b;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 16px;
            border-left: 4px solid #dc2626;
            font-weight: 500;
            font-size: 13px;
        }

        .success-message {
            background: #d1fae5;
            color: #065f46;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 16px;
            border-left: 4px solid #10b981;
            font-weight: 500;
            font-size: 13px;
        }

        .heart-divider {
            text-align: center;
            margin: 16px 0;
            position: relative;
            font-size: 12px;
        }

        .heart-divider::before {
            content: '💜 💜 💜';
            display: block;
            color: #7c3aed;
            letter-spacing: 6px;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                max-width: 100%;
                border-radius: 0;
            }

            .auth-left {
                padding: 40px 20px;
                min-height: auto;
                display: none;
            }

            .auth-right {
                padding: 30px 20px;
                max-height: none;
            }

            .form-header h1 {
                font-size: 24px;
            }

            .heart {
                font-size: 1rem;
            }
        }

        /* Scrollbar personnalisée */
        .auth-right::-webkit-scrollbar {
            width: 6px;
        }

        .auth-right::-webkit-scrollbar-track {
            background: #f0e9ff;
            border-radius: 3px;
        }

        .auth-right::-webkit-scrollbar-thumb {
            background: #7c3aed;
            border-radius: 3px;
        }

        .auth-right::-webkit-scrollbar-thumb:hover {
            background: #6d28d9;
        }
    </style>
</head>
<body>
    <!-- Coeurs violets flottants -->
    <div class="heart">💜</div>
    <div class="heart">💜</div>
    <div class="heart">💜</div>
    <div class="heart">💜</div>
    <div class="heart">💜</div>

    <div class="auth-container">
        <!-- Partie gauche avec message d'accueil -->
        <div class="auth-left">
            <div class="heart-emoji">💜</div>
            <h2>Rejoignez StockPro</h2>
            <p>
                Commencez votre gestion de stock dès aujourd'hui. 
                Une expérience moderne et intuitive vous attend.
            </p>
            <p style="font-size: 12px; opacity: 0.9;">
                Créé avec ❤️ pour votre succès
            </p>
        </div>

        <!-- Partie droite avec formulaire -->
        <div class="auth-right">
            <div class="form-header">
                <h1>✨ Inscription</h1>
                <p>Créez votre compte StockPro</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    <strong>⚠️</strong> {{ $errors->first() }}
                </div>
            @endif

            @if (session('error'))
                <div class="error-message">
                    <strong>⚠️</strong> {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="success-message">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/register">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="bi bi-person"></i> Nom Complet
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" placeholder="Votre nom complet" 
                           value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="text-danger small" style="font-size: 11px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope"></i> Email
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="votre@email.com" 
                           value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-danger small" style="font-size: 11px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i> Mot de passe
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="••••••••" 
                           required oninput="checkPasswordStrength(this.value)">
                    <div class="password-strength" style="margin-top: 8px;">
                        <div class="strength-bar" id="strengthBar" style="height: 4px; background: #e5e7eb; border-radius: 2px;"></div>
                        <span class="strength-text" id="strengthText" style="font-size: 11px; color: #6b7280;"></span>
                    </div>
                    @error('password')
                        <span class="text-danger small" style="font-size: 11px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="bi bi-check2-circle"></i> Confirmer le mot de passe
                    </label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="••••••••" required>
                    @error('password_confirmation')
                        <span class="text-danger small" style="font-size: 11px;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-person-check"></i> Créer mon compte
                </button>
            </form>

            <div class="heart-divider"></div>

            <div class="form-footer">
                <p>Déjà inscrit? <a href="{{ route('login') }}">Se connecter</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            // Critères
            const hasLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /\d/.test(password);

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
                strengthBar.style.background = '#dc2626';
            } else if (strength <= 50) {
                strengthText.textContent = 'Faible';
                strengthText.style.color = '#f59e0b';
                strengthBar.style.background = '#f59e0b';
            } else if (strength <= 75) {
                strengthText.textContent = 'Bon';
                strengthText.style.color = '#f59e0b';
                strengthBar.style.background = '#f59e0b';
            } else {
                strengthText.textContent = 'Très fort';
                strengthText.style.color = '#10b981';
                strengthBar.style.background = '#10b981';
            }
        }
    </script>
</body>
</html>
