<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function StarRate()
    {
        // $rateRange = [1, 2, 3, 4, 5];
        $rateStat = Rate::select("number_rating",DB::raw('count(rates.number_rating) as count_star'))
                    ->groupBy('number_rating')
                    ->get()
                    ->pluck("count_star","number_rating");
        // $dataStar = [];
        // foreach ($rateRange as $item) {
        //     $dataStar[$item] = $rateStat->get($item, 0);
        // }
        return [
           'dataStar' => $rateStat,
        ]; 
    }
}
