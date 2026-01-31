# 🚀 DÉMARRAGE DE STOCKPRO

## Étapes de Démarrage Rapide

### 1. **Démarrer MySQL** (si pas déjà en cours)

```powershell
# Terminal PowerShell (admin)
Start-Process "C:\xampp\mysql\bin\mysqld.exe" -WindowStyle Hidden
Start-Sleep -Seconds 2
```

### 2. **Naviguez vers le dossier du projet**

```powershell
cd C:\xampp\htdocs\mon
```

### 3. **Démarrer le serveur Laravel**

```powershell
php artisan serve
```

**Résultat attendu:**
```
INFO  Server running on [http://127.0.0.1:8000].
```

### 4. **Ouvrir l'application**

Ouvrez votre navigateur et allez à : **http://localhost:8000**

---

## 📋 Identifiants de Connexion

| Champ | Valeur |
|-------|--------|
| **Email** | admin@example.com |
| **Mot de passe** | password |

---

## 🗄️ Informations Base de Données

| Paramètre | Valeur |
|-----------|--------|
| **Serveur** | 127.0.0.1 |
| **Port** | 3306 |
| **Base de données** | mon |
| **Utilisateur** | root |
| **Mot de passe** | (vide) |

---

## ✨ Fonctionnalités Disponibles

✅ **Tableau de Bord** - Vue d'ensemble des stocks avec graphiques  
✅ **Gestion des Produits** - Ajouter, modifier, supprimer  
✅ **Catégories** - Organiser les produits  
✅ **Mouvements de Stock** - Enregistrer entrées/sorties  
✅ **Alertes** - Stocks bas, expirations, ruptures  
✅ **Authentification** - Gestion des utilisateurs  

---

## 🧹 Réinitialiser la Base de Données

Si vous devez remettre à zéro :

```powershell
cd C:\xampp\htdocs\mon
php artisan migrate:fresh --seed
```

Cela :
- 🗑️ Supprime toutes les tables
- 📝 Recrée les tables
- 📊 Remplit les données de test

---

## 📱 Pages Disponibles

- `/` - Tableau de bord
- `/products` - Liste des produits
- `/products/create` - Ajouter un produit
- `/categories` - Gestion des catégories
- `/movements` - Mouvements de stock
- `/alerts` - Alertes actives

---

## ⚠️ Problèmes Courants

### MySQL ne démarre pas
```powershell
# Vérifier les processus
Get-Process | Where-Object { $_.ProcessName -like "*mysql*" }

# Tuer les anciens processus si nécessaire
Stop-Process -Name mysqld -Force

# Redémarrer
Start-Process "C:\xampp\mysql\bin\mysqld.exe" -WindowStyle Hidden
```

### Erreur: "No database selected"
- Vérifiez que `.env` contient : `DB_DATABASE=mon`
- Vérifiez que la base de données MySQL est créée
- Relancez les migrations : `php artisan migrate:fresh --seed`

### Port 8000 déjà en utilisation
```powershell
# Utiliser un autre port
php artisan serve --port=8001
```

---

## 📞 Notes

- L'application nécessite **PHP 8.1+** et **Laravel 11**
- Les données sont stockées en **MySQL**
- L'interface utilise **Bootstrap 5** et **Chart.js**

---

**Créé en janvier 2026**
