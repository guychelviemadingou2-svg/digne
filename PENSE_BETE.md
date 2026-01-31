# ⚡ PENSE-BÊTE - COMMANDES ESSENTIELLES

## 🚀 Démarrage (Exécuter dans cet ordre)

```powershell
# 1. Démarrer MySQL
Start-Process "C:\xampp\mysql\bin\mysqld.exe" -WindowStyle Hidden

# 2. Naviguez au dossier
cd C:\xampp\htdocs\mon

# 3. Démarrer Laravel
php artisan serve

# 4. Ouvrir le navigateur
# http://localhost:8000
```

---

## 🔐 Identifiants Par Défaut

```
Email: admin@example.com
Mot de passe: password
```

---

## 📦 Installation (Première fois)

```powershell
composer install
php artisan migrate:fresh --seed
php artisan serve
```

---

## 🔄 Réinitialiser la BD

```powershell
# Supprimer et recréer toutes les tables
php artisan migrate:fresh --seed
```

---

## 🎮 Console Interactive

```powershell
php artisan tinker

# Exemples:
>>> \App\Models\Product::count()
>>> \App\Models\User::all()
>>> exit
```

---

## 🧹 Nettoyer le Cache

```powershell
php artisan optimize:clear
php artisan cache:clear
```

---

## 📊 Tables MySQL

```powershell
# Voir les tables
C:\xampp\mysql\bin\mysql -u root mon -e "SHOW TABLES;"

# Voir une table
C:\xampp\mysql\bin\mysql -u root mon -e "SELECT * FROM products;"

# Créer la BD
C:\xampp\mysql\bin\mysql -u root -e "CREATE DATABASE mon;"

# Supprimer la BD
C:\xampp\mysql\bin\mysql -u root -e "DROP DATABASE mon;"
```

---

## 🆘 Dépannage Rapide

```powershell
# MySQL ne démarre pas?
Start-Process "C:\xampp\mysql\bin\mysqld.exe" -WindowStyle Hidden

# Port 8000 occupé?
php artisan serve --port=8001

# Erreurs?
Get-Content storage/logs/laravel.log -Tail 20

# Tout réinitialiser?
php artisan migrate:fresh --seed
php artisan optimize:clear
```

---

## 📝 Créer rapidement

```powershell
# Modèle
php artisan make:model MonModele

# Contrôleur
php artisan make:controller MonController

# Migration
php artisan make:migration create_table_name

# Vue
php artisan make:view products.index
```

---

## 🔗 Routes Principales

```
/                    Dashboard
/products           Liste produits
/products/create    Ajouter produit
/categories         Gestion catégories
/movements          Mouvements stock
/alerts             Alertes
```

---

## 💾 Sauvegarde Rapide

```powershell
# Sauvegarder la BD
C:\xampp\mysql\bin\mysqldump -u root mon > backup.sql

# Restaurer
C:\xampp\mysql\bin\mysql -u root mon < backup.sql

# Zipper le projet
Compress-Archive -Path C:\xampp\htdocs\mon -DestinationPath mon_backup.zip
```

---

## ⚙️ Configuration .env

```env
DB_CONNECTION=mysql
DB_DATABASE=mon
DB_USERNAME=root
DB_PASSWORD=

APP_DEBUG=true
APP_ENV=local
```

---

**Garder ce fichier à proximité! 📌**
