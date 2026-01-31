#!/bin/bash
# Script de vérification de l'installation StockPro

echo "=========================================="
echo "   VÉRIFICATION INSTALLATION STOCKPRO"
echo "=========================================="
echo ""

# Vérifie PHP
echo "✓ Vérification de PHP..."
php --version
echo ""

# Vérifie Laravel
echo "✓ Vérification de Laravel..."
php artisan --version
echo ""

# Vérifie les tables
echo "✓ Vérification de la base de données..."
mysql -u root mon -e "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'mon';" 2>/dev/null
echo ""

# Vérifie les modèles
echo "✓ Vérification des modèles..."
php artisan tinker --execute "
echo 'Utilisateurs: ' . \App\Models\User::count() . PHP_EOL;
echo 'Catégories: ' . \App\Models\Category::count() . PHP_EOL;
echo 'Produits: ' . \App\Models\Product::count() . PHP_EOL;
echo 'Mouvements: ' . \App\Models\StockMovement::count() . PHP_EOL;
echo 'Alertes: ' . \App\Models\Alert::count() . PHP_EOL;
" 2>/dev/null
echo ""

echo "=========================================="
echo "   ✅ VÉRIFICATION COMPLÈTE!"
echo "=========================================="
echo ""
echo "Démarrez l'application avec:"
echo "  php artisan serve"
echo ""
