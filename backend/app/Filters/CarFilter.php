<?php

namespace App\Filters;

class CarFilter
{
    public function apply($query, array $filters)
    {
        $query->when($filters['make_id'] ?? null,
            fn($q, $v) => $q->where('make_id', $v)
        );

        $query->when($filters['model_id'] ?? null,
            fn($q, $v) => $q->where('model_id', $v)
        );

        $query->when($filters['fuel_type_id'] ?? null,
            fn($q, $v) => $q->where('fuel_type_id', $v)
        );

        $query->when($filters['body_type_id'] ?? null,
            fn($q, $v) => $q->where('body_type_id', $v)
        );

        $query->when($filters['transmission_id'] ?? null,
            fn($q, $v) => $q->where('transmission_id', $v)
        );

        // PRICE RANGE
        $query->when($filters['price_min'] ?? null,
            fn($q, $v) => $q->where('price', '>=', $v)
        );

        $query->when($filters['price_max'] ?? null,
            fn($q, $v) => $q->where('price', '<=', $v)
        );

        // YEAR RANGE
        $query->when($filters['year_min'] ?? null,
            fn($q, $v) => $q->where('year', '>=', $v)
        );

        $query->when($filters['year_max'] ?? null,
            fn($q, $v) => $q->where('year', '<=', $v)
        );

        // MILEAGE
        $query->when($filters['mileage_max'] ?? null,
            fn($q, $v) => $q->where('mileage', '<=', $v)
        );

        // SORT
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDir = $filters['sort_dir'] ?? 'desc';

        $query->orderBy($sortBy, $sortDir);

        return $query;
    }
}

?>