<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Alert;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un admin
        $admin = User::factory()
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);

        // Créer des utilisateurs normaux
        User::factory(5)->create();

        // Créer les catégories
        $categories = [
            ['name' => 'Électronique', 'description' => 'Produits électroniques'],
            ['name' => 'Vêtements', 'description' => 'Vêtements et accessoires'],
            ['name' => 'Alimentation', 'description' => 'Produits alimentaires'],
            ['name' => 'Meubles', 'description' => 'Mobilier et décoration'],
            ['name' => 'Autres', 'description' => 'Autres produits'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Créer des produits
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Smartphone haut de gamme',
                'category_id' => 1,
                'price' => 999.99,
                'quantity' => 2,
                'minimum_quantity' => 10,
            ],
            [
                'name' => 'MacBook Air M3',
                'description' => 'Ordinateur portable',
                'category_id' => 1,
                'price' => 1299.99,
                'quantity' => 5,
                'minimum_quantity' => 5,
            ],
            [
                'name' => 'AirPods Pro 2',
                'description' => 'Écouteurs sans fil',
                'category_id' => 1,
                'price' => 249.99,
                'quantity' => 0,
                'minimum_quantity' => 20,
            ],
            [
                'name' => 'iPad Pro 12.9',
                'description' => 'Tablette haut de gamme',
                'category_id' => 1,
                'price' => 1099.99,
                'quantity' => 8,
                'minimum_quantity' => 5,
            ],
            [
                'name' => 'Apple Watch Ultra',
                'description' => 'Montre intelligente',
                'category_id' => 1,
                'price' => 799.99,
                'quantity' => 12,
                'minimum_quantity' => 10,
            ],
            [
                'name' => 'Lot Batteries AA',
                'description' => 'Piles rechargeables',
                'category_id' => 3,
                'price' => 19.99,
                'quantity' => 50,
                'minimum_quantity' => 30,
                'expiry_date' => now()->addDays(7),
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Créer des mouvements de stock
        $movements = [
            ['product_id' => 1, 'type' => 'entrée', 'quantity' => 50, 'user_id' => $admin->id, 'notes' => 'Stock initial'],
            ['product_id' => 2, 'type' => 'entrée', 'quantity' => 15, 'user_id' => $admin->id, 'notes' => 'Livraison fournisseur'],
            ['product_id' => 1, 'type' => 'sortie', 'quantity' => 48, 'user_id' => $admin->id, 'notes' => 'Vente client'],
            ['product_id' => 3, 'type' => 'entrée', 'quantity' => 100, 'user_id' => $admin->id, 'notes' => 'Stock initial'],
            ['product_id' => 3, 'type' => 'sortie', 'quantity' => 100, 'user_id' => $admin->id, 'notes' => 'Ventes'],
        ];

        foreach ($movements as $movement) {
            StockMovement::create($movement);
        }

        // Créer des alertes
        $alerts = [
            [
                'product_id' => 1,
                'type' => 'stock_critique',
                'message' => 'Stock critique - 2 unités restantes',
                'resolved' => false,
            ],
            [
                'product_id' => 2,
                'type' => 'seuil_minimum',
                'message' => 'Seuil minimum atteint - 5 unités',
                'resolved' => false,
            ],
            [
                'product_id' => 6,
                'type' => 'expire_bientot',
                'message' => 'Expire dans 7 jours',
                'resolved' => false,
            ],
            [
                'product_id' => 3,
                'type' => 'rupture_imminente',
                'message' => 'Rupture de stock imminente',
                'resolved' => false,
            ],
        ];

        foreach ($alerts as $alert) {
            Alert::create($alert);
        }

        // Donner le rôle admin à l'admin créé
        $admin->role = 'admin';
        $admin->save();
    }
}

