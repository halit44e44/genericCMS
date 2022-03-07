<?php

namespace App\Http\Controllers;

use App\Models\ExchangePrices;
use App\Repositories\ExchangePricesRepository;
use Illuminate\Http\Request;

class ExchangePricesController extends Controller
{

    public function __construct(ExchangePricesRepository $exchangeRepository)
    {

        $this->exchangeRepo = $exchangeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = $this->exchangeRepo->getCurrencies();
        return view('exchangePrices.index')->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exchange = $this->exchangeRepo->save($request);
        return redirect()->route('exchangePrices.index')->with($exchange);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = ExchangePrices::find($id);
        $currency->delete();
        return redirect()->route('exchangePrices.index')->with('success', 'Currency deleted successfully');
    }

    function saveCurrency(Request $request)
    {
        $result = $this->exchangeRepo->save($request);
        return $result;
    }
}
