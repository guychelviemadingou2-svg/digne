<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StockPro — Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
      :root{--card-bg:rgba(255,255,255,0.06);--accent:#7c3aed}
      html,body{height:100%}
      body{margin:0;font-family:'Inter', 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;background-image:url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&s=6b2b8b4e7f8a2e0f0d6b3d3f7f0f9a2b');background-size:cover;background-position:center;color:#fff;display:flex;align-items:center;justify-content:center;padding:24px}
      .overlay{position:fixed;inset:0;background:linear-gradient(180deg,rgba(8,6,20,0.6),rgba(8,6,20,0.7));pointer-events:none}
      .login-card{width:100%;max-width:460px;background:var(--card-bg);border-radius:12px;padding:28px;backdrop-filter: blur(6px);box-shadow:0 20px 50px rgba(2,1,12,0.6);border:1px solid rgba(255,255,255,0.05);position:relative;z-index:2}
      .logo{display:flex;align-items:center;gap:12px}
      .mark{width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#5b21b6);display:flex;align-items:center;justify-content:center;font-weight:700}
      h2{font-family:'Poppins',sans-serif;margin:0;font-size:18px}
      p.desc{margin:0;color:rgba(255,255,255,0.76);font-size:13px}
      .form-control{border-radius:10px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.06);color:#fff;padding:12px}
      .form-control::placeholder{color:rgba(255,255,255,0.36)}
      .btn-accent{background:linear-gradient(90deg,var(--accent),#5b21b6);border:none;border-radius:10px;padding:10px 14px;font-weight:600}
      .muted{color:rgba(255,255,255,0.65);font-size:13px}
      .bottom-note{font-size:12px;color:rgba(255,255,255,0.5);margin-top:12px}
      @media (max-width:520px){body{padding:12px}.login-card{padding:18px}}
    </style>
  </head>
  <body>
    <div class="overlay"></div>

    <main class="login-card">
      <div class="logo mb-3">
        <div class="mark">SP</div>
        <div>
          <h2>StockPro</h2>
          <p class="desc">Connexion sécurisée — gestion professionnelle</p>
        </div>
      </div>

      @if ($errors->any())
        <div class="mb-3"><div class="alert alert-danger py-2">{{ $errors->first() }}</div></div>
      @endif
      @if (session('error'))
        <div class="mb-3"><div class="alert alert-danger py-2">{{ session('error') }}</div></div>
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
          <div><a href="#" class="muted" style="text-decoration:underline;color:rgba(255,255,255,0.9)">Mot de passe oublié?</a></div>
        </div>

        <div class="d-grid mb-2">
          <button class="btn btn-accent" type="submit">Se connecter</button>
        </div>
      </form>

      <div class="text-center">
        <p class="muted mb-2">Pas encore inscrit ? <a href="{{ route('register') }}" style="color:rgba(255,255,255,0.95);text-decoration:underline">Créer un compte</a></p>
        <div class="bottom-note">Identifiants de démo — admin@example.com / password</div>
      </div>

      <div style="margin-top:16px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.04);text-align:center;font-size:11px;color:rgba(255,255,255,0.5)">
        image et chic : 
        <a href="/login-bg" style="color:#7c3aed;text-decoration:underline;margin:0 4px;font-weight:600">Image</a>
        <a href="/login-chic" style="color:rgba(255,255,255,0.7);text-decoration:underline;margin:0 4px">Chic</a>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
