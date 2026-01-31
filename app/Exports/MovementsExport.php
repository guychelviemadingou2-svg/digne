<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class MovementsExport implements FromCollection, WithHeadings, WithMapping
{
    protected Collection $movements;

    public function __construct(Collection $movements)
    {
        $this->movements = $movements;
    }

    public function collection()
    {
        return $this->movements;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Produit',
            'Type',
            'Quantité',
            'Notes',
            'Utilisateur'
        ];
    }

    public function map($m): array
    {
        return [
            $m->id,
            $m->created_at?->format('Y-m-d H:i:s'),
            $m->product?->name,
            $m->type,
            (int) $m->quantity,
            $m->notes,
            $m->user?->name,
        ];
    }
}
