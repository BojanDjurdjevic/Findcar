<?php

namespace App\Filters;

class CarFilter
{
    public function apply($query, array $filters)
    {
        $filters = array_filter($filters, fn($v) => $v !== null && $v !== '');
        /*
        $query->when($filters['search'] ?? null, function ($q, $search) {
            try {
                $q->where(function ($qq) use ($search) {
                    $qq->where('title', 'like', "%{$search}%")
                        ->orWhereHas('make', function ($m) use ($search) {
                            $m->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('model', function ($m) use ($search) {
                            $m->where('name', 'like', "%{$search}%");
                        });
                });
            } catch (\Throwable $e) {
                dd('SEARCH ERROR:', $e->getMessage());
            }
        }); */

        $query->when($filters['search'] ?? null, function ($q, $search) {
            $search = trim($search);

            $q->where(function ($qq) use ($search) {
                $qq->where('title', 'like', "%{$search}%")
                    ->orWhereHas('make', function ($m) use ($search) {
                        $m->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('model', function ($m) use ($search) {
                        $m->where('name', 'like', "%{$search}%");
                    });
            });
        });

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
        $allowedSorts = ['price', 'year', 'mileage', 'created_at'];

        $sortBy = $filters['sort_by'] ?? 'created_at';

        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $sortDir = $filters['sort_dir'] ?? 'desc';

        if (!in_array($sortDir, ['asc', 'desc'])) {
            $sortDir = 'desc';
        }

        $query->orderBy($sortBy, $sortDir);

        return $query;
    }
}

?>