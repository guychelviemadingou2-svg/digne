<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    protected Collection $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom Produit',
            'Catégorie',
            'Prix Unitaire',
            'Quantité',
            'Seuil Minimum',
            'Valeur Totale',
            'Critique'
        ];
    }

    public function map($product): array
    {
        $value = (float) $product->price * (int) $product->quantity;
        $isCritical = $product->quantity <= $product->minimum_quantity ? 'OUI' : 'NON';

        return [
            $product->id,
            $product->name,
            optional($product->category)->name,
            (float) $product->price,
            (int) $product->quantity,
            (int) $product->minimum_quantity,
            $value,
            $isCritical,
        ];
    }
}
