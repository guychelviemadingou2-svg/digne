<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StockPro — Connexion chic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
      :root{--bg-1:#120617;--bg-2:#2a133b;--accent:#8b5cf6;--card:rgba(255,255,255,0.04)}
      html,body{height:100%}
      body{margin:0;font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;background:linear-gradient(180deg,var(--bg-1),var(--bg-2));display:flex;align-items:center;justify-content:center;color:#fff;padding:28px}
      .page{width:100%;max-width:980px;display:grid;grid-template-columns:1fr 420px;gap:28px;align-items:center}

      /* Left panel — simple marketing */
      .panel{padding:36px;border-radius:14px;background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));backdrop-filter:blur(6px);box-shadow:0 20px 50px rgba(2,1,12,0.6);border:1px solid rgba(255,255,255,0.03)}
      .panel h2{font-family:'Playfair Display',serif;font-size:28px;margin:0 0 10px;color:#fff}
      .panel p{color:rgba(255,255,255,0.78);margin:0 0 12px}

      /* Card */
      .card-login{padding:28px;border-radius:12px;background:var(--card);border:1px solid rgba(255,255,255,0.04)}
      .brand{display:flex;align-items:center;gap:12px;margin-bottom:18px}
      .logo{width:52px;height:52px;border-radius:12px;background:linear-gradient(135deg,var(--accent),#5b21b6);display:flex;align-items:center;justify-content:center;font-weight:700;font-family:'Playfair Display',serif}
      h1.title{font-size:18px;margin:0}
      .muted{color:rgba(255,255,255,0.7);font-size:13px}

      .form-control{border-radius:10px;background:transparent;border:1px solid rgba(255,255,255,0.06);color:#fff;padding:12px}
      .form-control::placeholder{color:rgba(255,255,255,0.36)}
      .btn-accent{background:linear-gradient(90deg,var(--accent),#5b21b6);border:none;border-radius:10px;padding:10px 14px;font-weight:600}
      .small-note{font-size:12px;color:rgba(255,255,255,0.55)}

      .hearts{position:absolute;pointer-events:none;left:16px;top:16px;opacity:0.06;font-size:48px}

      @media (max-width:980px){.page{grid-template-columns:1fr;gap:18px}.hearts{display:none}}
    </style>
  </head>
  <body>
    <div class="hearts">💜</div>

    <div class="page">
      <div class="panel">
        <h2>StockPro — Gestion chic et fiable</h2>
        <p>Une interface claire, des couleurs harmonieuses et une police lisible pour une expérience agréable au quotidien. Accédez rapidement à vos produits, mouvements et rapports.</p>
        
        <div style="margin-top:24px">
          <h3 style="font-size:14px;color:rgba(255,255,255,0.95);margin-bottom:8px">✨ Exports</h3>
          <p class="small-note">PDF : Rapports & fiches produit • Excel : États de stock & mouvements • API programmatique</p>
        </div>

        <div style="margin-top:18px">
          <h3 style="font-size:14px;color:rgba(255,255,255,0.95);margin-bottom:8px">🔔 Alertes</h3>
          <p class="small-note">Seuils minimum • Expiration produits • Notifications email • Dashboard temps réel</p>
        </div>

        <p class="small-note" style="margin-top:18px">Design épuré • Conçu pour la lisibilité • Accent violet élégant</p>
      </div>

      <aside class="card-login">
        <div class="brand">
          <div class="logo">SP</div>
          <div>
            <h1 class="title">Se connecter</h1>
            <div class="muted">Entrez vos identifiants pour continuer</div>
          </div>
        </div>

        @if ($errors->any())
          <div class="mb-3"><div class="alert alert-danger py-2">{{ $errors->first() }}</div></div>
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
            <label class="form-label small-note">Email</label>
            <input type="email" name="email" class="form-control" placeholder="votre@email.com" value="{{ old('email') }}" required autofocus>
          </div>

          <div class="mb-3">
            <label class="form-label small-note">Mot de passe</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label small-note" for="remember">Rester connecté</label>
            </div>
            <div><a href="#" class="small-note" style="text-decoration:underline;color:rgba(255,255,255,0.9)">Mot de passe oublié?</a></div>
          </div>

          <div class="d-grid mb-2">
            <button class="btn btn-accent" type="submit">Se connecter</button>
          </div>
        </form>

        <div class="text-center mt-3" style="border-top:1px solid rgba(255,255,255,0.04);padding-top:16px">
          <div class="small-note">Pas encore de compte ? <a href="{{ route('register') }}" style="color:#fff;text-decoration:underline">Créer un compte</a></div>
        </div>

        <div style="margin-top:18px;padding:14px;border-radius:8px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04)">
          <div class="small-note" style="font-weight:600;margin-bottom:8px">📋 Comptes de test :</div>
          <div class="small-note" style="margin:6px 0"><strong>Admin:</strong> admin@example.com</div>
          <div class="small-note" style="margin:6px 0"><strong>Gestionnaire:</strong> manager@example.com</div>
          <div class="small-note" style="margin:6px 0"><strong>Observateur:</strong> viewer@example.com</div>
          <div class="small-note" style="margin-top:8px;color:rgba(255,255,255,0.5)">Mot de passe pour tous : password</div>
        </div>

        <div style="margin-top:16px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.04);text-align:center;font-size:11px;color:rgba(255,255,255,0.5)">
          image et chic : 
          <a href="/login-bg" style="color:rgba(255,255,255,0.7);text-decoration:underline;margin:0 4px">Image</a>
          <a href="/login-chic" style="color:#8b5cf6;text-decoration:underline;margin:0 4px;font-weight:600">Chic</a>
        </div>
      </aside>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
