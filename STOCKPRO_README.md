# StockPro - Système de Gestion de Stock

Un système complet de gestion de stock basé sur Laravel avec une base de données MySQL.

## 📋 Caractéristiques

- 📊 **Tableau de bord** avec statistiques en temps réel
- 📦 **Gestion des produits** (CRUD complet)
- 🏷️ **Gestion des catégories**
- 📈 **Suivi des mouvements de stock** (entrées/sorties)
- ⚠️ **Système d'alertes** pour les stocks bas, expirations, etc.
- 📊 **Graphiques** d'évolution et de répartition
- 👥 **Authentification utilisateur** intégrée

## 🗄️ Base de Données

### Structure MySQL

```
DATABASE: mon
TABLES:
- users
- categories
- products
- stock_movements
- alerts
- personal_access_tokens
- password_reset_tokens
- failed_jobs
```

### Tables principales

#### `categories`
- `id` (INT, PK)
- `name` (VARCHAR)
- `description` (TEXT)

#### `products`
- `id` (INT, PK)
- `name` (VARCHAR)
- `description` (TEXT)
- `category_id` (INT, FK)
- `price` (DECIMAL)
- `quantity` (INT)
- `minimum_quantity` (INT)
- `expiry_date` (DATE)

#### `stock_movements`
- `id` (INT, PK)
- `product_id` (INT, FK)
- `type` (ENUM: 'entrée', 'sortie')
- `quantity` (INT)
- `user_id` (INT, FK)
- `notes` (TEXT)

#### `alerts`
- `id` (INT, PK)
- `product_id` (INT, FK)
- `type` (ENUM: 'stock_critique', 'seuil_minimum', 'expire_bientot', 'rupture_imminente')
- `message` (TEXT)
- `resolved` (BOOLEAN)

## 🚀 Installation

### 1. Configuration de la Base de Données

```bash
# Créer la base de données MySQL
mysql -u root -p
CREATE DATABASE mon;
EXIT;
```

### 2. Fichier .env

Modifiez le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mon
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrations

```bash
# Installer les dépendances
composer install

# Exécuter les migrations
php artisan migrate

# Remplir la base de données avec les données de test
php artisan db:seed
```

### 4. Démarrer l'application

```bash
# Serveur Laravel
php artisan serve

# L'application sera disponible à : http://localhost:8000
```

## 📝 Identifiants de Connexion

Après le seeding, vous pouvez vous connecter avec :

- **Email** : admin@example.com
- **Mot de passe** : password

## 📂 Structure du Projet

```
app/
├── Http/Controllers/
│   ├── DashboardController.php
│   ├── ProductController.php
│   ├── CategoryController.php
│   ├── StockMovementController.php
│   └── AlertController.php
└── Models/
    ├── User.php
    ├── Category.php
    ├── Product.php
    ├── StockMovement.php
    └── Alert.php

database/
├── factories/
│   ├── CategoryFactory.php
│   └── ProductFactory.php
└── seeders/
    └── DatabaseSeeder.php

resources/views/
├── layouts/
│   └── app.blade.php
├── dashboard/
│   └── index.blade.php
├── products/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── categories/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── movements/
│   ├── index.blade.php
│   └── create.blade.php
└── alerts/
    └── index.blade.php
```

## 🔄 Routes Disponibles

| Route | Méthode | Description |
|-------|---------|-------------|
| `/` | GET | Tableau de bord |
| `/products` | GET | Liste des produits |
| `/products/create` | GET | Créer un produit |
| `/products` | POST | Ajouter un produit |
| `/products/{id}/edit` | GET | Éditer un produit |
| `/products/{id}` | PUT | Mettre à jour |
| `/products/{id}` | DELETE | Supprimer |
| `/categories` | GET | Liste des catégories |
| `/categories/create` | GET | Créer une catégorie |
| `/categories` | POST | Ajouter une catégorie |
| `/categories/{id}/edit` | GET | Éditer |
| `/categories/{id}` | PUT | Mettre à jour |
| `/categories/{id}` | DELETE | Supprimer |
| `/movements` | GET | Liste des mouvements |
| `/movements/create` | GET | Nouveau mouvement |
| `/movements` | POST | Ajouter un mouvement |
| `/alerts` | GET | Liste des alertes |
| `/alerts/{id}/resolve` | POST | Marquer comme résolu |
| `/alerts/{id}` | DELETE | Supprimer une alerte |

## 🎨 Design

L'interface utilise :
- **Bootstrap 5** pour le responsive design
- **Bootstrap Icons** pour les icônes
- **Chart.js** pour les graphiques
- **Gradient Purple** comme thème principal

## 🔐 Authentification

Les routes sont protégées par le middleware `auth`. Seuls les utilisateurs connectés peuvent accéder à l'application.

## 📊 Dashboard

Le tableau de bord affiche :
- **Statistiques clés** : Nombre de produits, valeur du stock, taux de rotation, alertes
- **Graphique d'évolution** : Entrées/sorties mensuelles
- **Répartition par catégorie** : Graphique en donuts
- **Mouvements récents** : 5 derniers mouvements
- **Alertes récentes** : 4 dernières alertes actives

## ✅ Fonctionnalités Implémentées

- ✅ CRUD Produits
- ✅ CRUD Catégories
- ✅ Enregistrement des mouvements
- ✅ Système d'alertes
- ✅ Tableaux et graphiques
- ✅ Authentification
- ✅ Validation des données
- ✅ Donnees de test (seeding)

## 🛠️ Technologie

- **PHP 8.1+**
- **Laravel 11**
- **MySQL 5.7+**
- **Bootstrap 5**
- **Chart.js**

## 📞 Support

Pour toute question ou problème, veuillez consulter la documentation Laravel : https://laravel.com/docs

---

**Créé en janvier 2026**
