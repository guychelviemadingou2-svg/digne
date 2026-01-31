# 🛠️ COMMANDES UTILES STOCKPRO

## 🚀 Démarrage

```powershell
# Démarrer MySQL
Start-Process "C:\xampp\mysql\bin\mysqld.exe" -WindowStyle Hidden

# Démarrer Laravel
cd C:\xampp\htdocs\mon
php artisan serve

# Accéder à l'app
# http://localhost:8000
```

---

## 🗄️ Base de Données

### Migrations

```powershell
# Exécuter toutes les migrations
php artisan migrate

# Annuler les migrations
php artisan migrate:rollback

# Annuler tout et recommencer (ATTENTION!)
php artisan migrate:fresh

# Réinitialiser avec données de test
php artisan migrate:fresh --seed

# Voir le statut des migrations
php artisan migrate:status

# Spécifier un seeder particulier
php artisan migrate --seed --seeder=DatabaseSeeder
```

### Base de Données

```powershell
# Créer la base de données
C:\xampp\mysql\bin\mysql -u root -e "CREATE DATABASE mon DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Supprimer la base de données
C:\xampp\mysql\bin\mysql -u root -e "DROP DATABASE mon;"

# Vérifier les tables
C:\xampp\mysql\bin\mysql -u root mon -e "SHOW TABLES;"

# Faire un backup
C:\xampp\mysql\bin\mysqldump -u root mon > backup.sql

# Restaurer un backup
C:\xampp\mysql\bin\mysql -u root mon < backup.sql
```

---

## 🎮 Tinker - Console Interactive

```powershell
php artisan tinker

# Exemples d'utilisation:

# Créer un utilisateur
>>> \App\Models\User::create(['name' => 'John', 'email' => 'john@example.com', 'password' => bcrypt('password')])

# Lister tous les produits
>>> \App\Models\Product::all()

# Compter les produits
>>> \App\Models\Product::count()

# Trouver un produit
>>> \App\Models\Product::find(1)

# Trouver un produit par nom
>>> \App\Models\Product::where('name', 'iPhone 15 Pro')->first()

# Mettre à jour un produit
>>> $product = \App\Models\Product::find(1); $product->quantity = 100; $product->save()

# Supprimer un produit
>>> \App\Models\Product::find(1)->delete()

# Alertes non résolues
>>> \App\Models\Alert::where('resolved', false)->get()

# Mouvements récents
>>> \App\Models\StockMovement::latest()->take(5)->get()

# Quitter tinker
>>> exit
```

---

## 🔨 Cache et Optimisation

```powershell
# Effacer le cache
php artisan cache:clear

# Effacer les sessions
php artisan session:flush

# Effacer les vues compilées
php artisan view:clear

# Effacer les routes en cache
php artisan route:clear

# Optimiser tout
php artisan optimize

# Effacer l'optimisation
php artisan optimize:clear

# Tout effacer à la fois
php artisan optimize:clear
```

---

## 📦 Composer

```powershell
# Installer les dépendances
composer install

# Mettre à jour les dépendances
composer update

# Vérifier si les dépendances sont à jour
composer outdated

# Regénérer l'autoloader
composer dump-autoload

# Vérifier les fichiers autoload
composer dump-autoload -o
```

---

## 📊 Développement

```powershell
# Créer un modèle
php artisan make:model Product

# Créer un contrôleur
php artisan make:controller ProductController

# Créer une migration
php artisan make:migration create_products_table

# Créer un seeder
php artisan make:seeder ProductSeeder

# Créer une factory
php artisan make:factory ProductFactory

# Créer un événement
php artisan make:event ProductEvent

# Créer une notification
php artisan make:notification ProductAlert
```

---

## 🧪 Tests

```powershell
# Exécuter les tests
php artisan test

# Exécuter les tests avec couverture
php artisan test --coverage

# Exécuter un test spécifique
php artisan test tests/Unit/ProductTest.php
```

---

## 🐛 Debugging

```powershell
# Afficher les logs récents
tail -f storage/logs/laravel.log

# Afficher tout l'output
php artisan serve --verbose

# Mode debug activé
# Modifier dans .env: APP_DEBUG=true
```

---

## 🚀 Production (Futur)

```powershell
# Optimiser pour la production
php artisan optimize

# Compiler les ressources
npm run build

# Mettre en cache la configuration
php artisan config:cache

# Mettre en cache les routes
php artisan route:cache

# Désactiver le debug
# Dans .env: APP_DEBUG=false
```

---

## 🔐 Authentification

```powershell
# Générer des API tokens
php artisan sanctum:install

# Créer un nouvel utilisateur
php artisan tinker
>>> \App\Models\User::create(['name' => 'user', 'email' => 'user@example.com', 'password' => bcrypt('password')])
```

---

## 📝 Logs et Monitoring

```powershell
# Voir les logs en temps réel (Linux/Mac)
tail -f storage/logs/laravel.log

# Voir les logs en temps réel (Windows)
Get-Content storage/logs/laravel.log -Tail 10 -Wait

# Voir les erreurs
php artisan error:logs

# Nettoyer les vieux logs
php artisan logs:prune
```

---

## 🔍 Informations Système

```powershell
# Informations Laravel
php artisan about

# Vérifier la configuration
php artisan config:show database

# Lister les routes
php artisan route:list

# Lister les middlewares
php artisan middleware:list

# Vérifier les services
php artisan show:database
```

---

## 💾 Sauvegarde et Restauration

```powershell
# Sauvegarder la base de données
C:\xampp\mysql\bin\mysqldump -u root mon > backup_$(Get-Date -Format 'yyyyMMdd_HHmmss').sql

# Restaurer la base de données
C:\xampp\mysql\bin\mysql -u root mon < backup.sql

# Sauvegarder les fichiers
Compress-Archive -Path C:\xampp\htdocs\mon -DestinationPath mon_$(Get-Date -Format 'yyyyMMdd').zip
```

---

## 🆘 Troubleshooting

### Application ne démarre pas
```powershell
# Vérifier les erreurs
php artisan serve --verbose

# Vérifier les logs
Get-Content storage/logs/laravel.log -Tail 20
```

### Erreur de base de données
```powershell
# Vérifier la connexion MySQL
C:\xampp\mysql\bin\mysql -u root -e "SELECT 1"

# Réinitialiser la base
php artisan migrate:fresh --seed
```

### Port 8000 en utilisation
```powershell
# Utiliser un autre port
php artisan serve --port=8001

# Ou trouver le processus
Get-Process -Name php
```

---

## 📞 Aide Rapide

```powershell
# Lister toutes les commandes disponibles
php artisan

# Aide pour une commande
php artisan help migrate

# Version de Laravel
php artisan --version
```

---

**Bonne chance avec StockPro! 🚀**
