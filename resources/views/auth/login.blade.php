<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockPro - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <!doctype html>
            <html lang="fr">
              <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>StockPro — Connexion</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
                <style>
                  :root{--violet-50:#f5eefb;--violet-500:#7c3aed;--violet-700:#5b21b6;--bg:#0f0818}
                  *{box-sizing:border-box}
                  body{font-family:'Poppins',sans-serif;background:linear-gradient(180deg,var(--bg),#1b0f2a);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:32px;color:#fff}
                  .card-login{width:100%;max-width:420px;border-radius:14px;background:linear-gradient(180deg,rgba(255,255,255,0.04),rgba(255,255,255,0.02));backdrop-filter: blur(6px);box-shadow:0 10px 40px rgba(10,6,20,0.6);padding:28px;border:1px solid rgba(255,255,255,0.04)}
                  .brand{display:flex;align-items:center;gap:12px;margin-bottom:18px}
                  .brand .logo{width:46px;height:46px;border-radius:10px;background:linear-gradient(135deg,var(--violet-500),var(--violet-700));display:flex;align-items:center;justify-content:center;font-size:20px;box-shadow:0 6px 18px rgba(92,33,184,0.28)}
                  h1.title{font-family:'Playfair Display',serif;margin:0;font-size:20px;color:#fff}
                  p.lead{margin:0;color:rgba(255,255,255,0.75);font-size:13px}
                  .form-control{border-radius:10px;border:1px solid rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);color:#fff;padding:12px}
                  .form-control::placeholder{color:rgba(255,255,255,0.35)}
                  .btn-primary{background:linear-gradient(90deg,var(--violet-500),var(--violet-700));border:none;border-radius:10px;padding:10px 14px;font-weight:600}
                  .muted{font-size:13px;color:rgba(255,255,255,0.6)}
                  .divider{height:1px;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.04),transparent);margin:18px 0;border-radius:2px}
                  .hearts{position:fixed;pointer-events:none;inset:0;z-index:0}
                  .heart{position:absolute;font-size:24px;color:rgba(124,58,237,0.06)}
                  .heart.h1{left:6%;top:14%}.heart.h2{right:8%;top:24%}.heart.h3{left:20%;bottom:20%}
                  @media (max-width:420px){body{padding:18px}.card-login{padding:18px}}
                </style>
              </head>
              <body>
                <div class="hearts">
                  <div class="heart h1">💜</div>
                  <div class="heart h2">💜</div>
                  <div class="heart h3">💜</div>
                </div>

                <main class="card-login">
                  <div class="brand">
                    <div class="logo">SP</div>
                    <div>
                      <h1 class="title">StockPro</h1>
                      <p class="lead">Gestion simple et élégante de votre stock</p>
                    </div>
                  </div>

                  @if ($errors->any())
                    <div class="mb-3">
                      <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
                    </div>
                  @endif
                  @if (session('error'))
                    <div class="mb-3"><div class="alert alert-danger py-2">{{ session('error') }}</div></div>
                  @endif
                  @if (session('success'))
                    <div class="mb-3"><div class="alert alert-success py-2">{{ session('success') }}</div></div>
                  @endif

                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label muted">Email</label>
                      <input type="email" name="email" class="form-control" placeholder="votre@email.com" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                      <label class="form-label muted">Mot de passe</label>
                      <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label muted" for="remember">Rester connecté</label>
                      </div>
                      <div><a href="#" class="muted" style="text-decoration:underline;color:rgba(255,255,255,0.8)">Mot de passe oublié?</a></div>
                    </div>

                    <div class="d-grid">
                      <button class="btn btn-primary" type="submit">Se connecter</button>
                    </div>
                  </form>

                  <div class="divider"></div>

                  <div class="text-center">
                    <p class="muted mb-1">Pas encore de compte ?</p>
                    <a href="{{ route('register') }}" class="btn" style="background:transparent;border:1px solid rgba(255,255,255,0.06);color:#fff;border-radius:10px;padding:8px 12px">Créer un compte</a>
                  </div>

                  <div class="mt-3 muted" style="font-size:12px">Identifiants de démo — admin@example.com / password</div>

      <div style="margin-top:18px;padding-top:14px;border-top:1px solid rgba(255,255,255,0.04);text-align:center;font-size:11px;color:rgba(255,255,255,0.5)">
        image, chic et simple : 
        <a href="/login-bg" style="color:rgba(255,255,255,0.7);text-decoration:underline;margin:0 4px">Image</a>
        <a href="/login-chic" style="color:rgba(255,255,255,0.7);text-decoration:underline;margin:0 4px">Chic</a>
        <a href="/login" style="color:#7c3aed;text-decoration:underline;margin:0 4px;font-weight:600">Simple</a>
      </div>
