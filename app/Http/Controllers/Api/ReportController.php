<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diches;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report()
    {
        $total_prices = Diches::all();
        if (count($total_prices) > 1) {
            $total_prices = $total_prices->reduce(function ($total, $diches) {
                return $total + intval($diches->count) * floatval($diches->price);
            }, 0);
        } elseif (count($total_prices) == 1) $total_prices = intval($total_prices[0]->count) * intval($total_prices[0]->price);
        else $total_prices = 0;
        return ['success' => true, 'result' => $total_prices];
    }
}
