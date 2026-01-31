# 📦 INSTALLATION COMPLÈTE - StockPro

Ceci est un guide complet pour cloner/réinstaller l'application.

## ✅ Prérequis

- **PHP 8.1+** 
- **Composer**
- **MySQL 5.7+**
- **Node.js** (optionnel, pour npm)
- **XAMPP** (contient PHP et MySQL)

---

## 🔧 Installation Étape par Étape

### **Étape 1: Cloner/Copier le Projet**

```powershell
# Ou copier le dossier 'mon' depuis ailleurs
cd C:\xampp\htdocs\mon
```

### **Étape 2: Installer les Dépendances**

```powershell
cd C:\xampp\htdocs\mon
composer install
```

### **Étape 3: Créer le Fichier .env**

```powershell
# Copier le fichier d'exemple
Copy-Item .env.example .env

# Ou créer un nouveau avec ces paramètres:
```

Contenu du fichier `.env` :

```env
APP_NAME=StockPro
APP_ENV=local
APP_KEY=base64:hcUd3Az89WXmcmPhvoWoNdiAtVzDw7yhguOWR0YCMiE=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mon
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
```

### **Étape 4: Générer la Clé d'Application**

```powershell
php artisan key:generate
```

### **Étape 5: Démarrer MySQL**

```powershell
# Si MySQL n'est pas déjà en cours d'exécution
Start-Process "C:\xampp\mysql\bin\mysqld.exe" -WindowStyle Hidden
Start-Sleep -Seconds 2
```

### **Étape 6: Créer la Base de Données**

```powershell
C:\xampp\mysql\bin\mysql -u root -e "DROP DATABASE IF EXISTS mon; CREATE DATABASE mon DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### **Étape 7: Exécuter les Migrations et Seeding**

```powershell
cd C:\xampp\htdocs\mon
php artisan migrate:fresh --seed
```

### **Étape 8: Démarrer le Serveur**

```powershell
php artisan serve
```

### **Étape 9: Accéder à l'Application**

Ouvrez votre navigateur et allez à :
```
http://localhost:8000
```

---

## 🔐 Premier Accès

**Données de test créées automatiquement:**

| Email | Mot de passe | Rôle |
|-------|-------------|------|
| admin@example.com | password | Admin |

---

## 📊 Données de Test Incluses

L'application est pré-remplie avec :

- **6 Utilisateurs** (1 admin + 5 normaux)
- **5 Catégories** (Électronique, Vêtements, etc.)
- **6 Produits** (iPhone, MacBook, AirPods, etc.)
- **5 Mouvements de Stock** (historique)
- **4 Alertes** (stocks critiques, expirations, etc.)

---

## 🛠️ Structure du Projet

```
mon/
├── app/
│   ├── Http/Controllers/     # Contrôleurs
│   ├── Models/               # Modèles Eloquent
│   └── Exceptions/
├── database/
│   ├── migrations/           # Migrations SQL
│   ├── factories/            # Factories pour données de test
│   └── seeders/              # Seeders
├── resources/
│   ├── views/                # Vues Blade
│   ├── css/
│   └── js/
├── routes/
│   └── web.php               # Routes
├── .env                      # Variables d'environnement
├── config/                   # Fichiers de configuration
├── public/                   # Fichiers publics
└── storage/                  # Logs et cache
```

---

## 🔄 Commandes Utiles

### Migrations

```powershell
# Exécuter toutes les migrations
php artisan migrate

# Annuler la dernière migration
php artisan migrate:rollback

# Réinitialiser et remplir (DESTRUCTEUR!)
php artisan migrate:fresh --seed

# Afficher le statut des migrations
php artisan migrate:status
```

### Tinker (Console Interactive)

```powershell
# Accéder à la console interactive
php artisan tinker

# Exemples:
>>> \App\Models\Product::count()
>>> \App\Models\User::all()
>>> \App\Models\Alert::where('resolved', false)->count()
```

### Cache et Sessions

```powershell
# Vider le cache
php artisan cache:clear

# Vider les sessions
php artisan session:flush

# Vider tout
php artisan optimize:clear
```

---

## 📖 Documentation Utile

- [Laravel Documentation](https://laravel.com/docs)
- [Blade Templating](https://laravel.com/docs/11.x/blade)
- [Eloquent ORM](https://laravel.com/docs/11.x/eloquent)
- [MySQL Documentation](https://dev.mysql.com/doc/)

---

## ⚙️ Configuration Supplémentaire (Optionnel)

### Activer les Logs Détaillés

Dans `.env` :
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

### Changer de Port

```powershell
php artisan serve --port=8001
```

### Changer l'URL

Dans `.env` :
```env
APP_URL=http://votre-domaine.com
```

---

## 🐛 Dépannage

### Erreur: "Class not found"
```powershell
composer dump-autoload
```

### Erreur: "No such file or directory"
```powershell
# Vérifier le chemin du projet
pwd
# Doit être: C:\xampp\htdocs\mon
```

### Erreur: "SQLSTATE[HY000]"
```powershell
# MySQL n'est pas démarré
Start-Process "C:\xampp\mysql\bin\mysqld.exe" -WindowStyle Hidden
```

### Erreur: "Specified key was too long"
```powershell
# Problem avec les clés. Réexécuter:
php artisan migrate:fresh --seed
```

---

## 🎉 Vérification Finale

Pour vérifier que tout fonctionne :

```powershell
php artisan tinker

# Exécuter ces commandes:
>>> \App\Models\User::count()           # Doit afficher: 6
>>> \App\Models\Product::count()        # Doit afficher: 6
>>> \App\Models\Alert::count()          # Doit afficher: 4
>>> \App\Models\Category::count()       # Doit afficher: 5
```

---

## 📞 Support

Pour toute question, consultez :
- Documentation officielle Laravel
- Fichier STOCKPRO_README.md
- Fichier DEMARRAGE.md

---

**Installation complétée avec succès! Profitez de StockPro! 🎉**
