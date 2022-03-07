<?php

namespace App\Repositories;

use App\Models\ExchangePrices;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class ExchangePricesRepository extends EloquentRepository
{
    function save($request)
    {
        if ($request->get('id')) {
            $exchange = ExchangePrices::where('id', $request->get('id'))->first();
            $exchange->currency_price = $request->get('currency_price');
            $action = 'updated';
        } else {
            // dd($request);
            $exchange = new ExchangePrices();
            $exchange->currency = $request->get('currency');
            $exchange->currency_price = $request->get('currency_price');
            $exchange->currency_code = $request->get('currency_code');
            $exchange->isActive = $request->boolean('isActive');
            $action = 'created';
        }
        $exchange->save();
    }

    function getCurrencies()
    {
        $data = ExchangePrices::latest()->get();
        return $data;
    }
}
