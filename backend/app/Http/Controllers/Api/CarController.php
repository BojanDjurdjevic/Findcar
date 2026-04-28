<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchCarRequest;
use App\Http\Resources\CarListResource;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarSearchService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(SearchCarRequest $request)
    {
        $service = new CarSearchService();
        $cars = $service->search($request->validated());

        return CarListResource::collection($cars);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Car $car)
    {
        $car->load([
            'make',
            'model',
            'fuelType',
            'bodyType',
            'transmission',
            'features',
            'images',
            'user'
        ]);

        return new CarResource($car);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
