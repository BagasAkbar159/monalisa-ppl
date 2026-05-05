<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function getDistricts($cityId): JsonResponse
    {
        $districts = District::where('city_id', $cityId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($districts);
    }
}