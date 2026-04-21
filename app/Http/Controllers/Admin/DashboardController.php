<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenProduction;
use App\Models\Customer;
use App\Models\Driver;

class DashboardController extends Controller
{
    public function index()
    {
        $totalChicken = ChickenProduction::sum('quantity_chicken');
        $totalWeight = ChickenProduction::sum('total_weight_kg');
        $totalCustomers = Customer::count();
        $totalDrivers = Driver::count();

        return view('admin.dashboard', compact(
            'totalChicken',
            'totalWeight',
            'totalCustomers',
            'totalDrivers'
        ));
    }
}