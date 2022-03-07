<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartJsController extends Controller
{
    // public function transactionJs()
    // {
    //     $data = Transaction::select('company_id',DB::raw("COUNT(*) as id "))->groupBy('company_id')->pluck('id','company_id')->all();
    //     return $data;

    // }


}
