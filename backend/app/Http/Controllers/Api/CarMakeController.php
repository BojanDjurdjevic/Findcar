<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarMake;
use Illuminate\Http\Request;

class CarMakeController extends Controller
{
    public function index()
    {
        return CarMake::select('id', 'name')
        ->orderBy('name')
        ->get();
    }

    public function models(CarMake $make)
    {
        return $make->models()->select('id', 'name')
        ->orderBy('name')
        ->get();
    }
}
