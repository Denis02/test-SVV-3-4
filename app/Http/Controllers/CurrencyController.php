<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\StoreCurrency;
use App\Http\Requests\UpdateCurrency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Currency::orderBy('currency', 'desc')->paginate(5);
        if($request->ajax())
        {
            return view('components.currencies', compact('data'))->render();
        }else{
            return view('home', compact('data'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $data = Currency::where('currency', $code)->first();
        return view('components.currency', compact('data'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrency $request)
    {
        $validated = $request->validated();

        $data = new Currency();
        $data->currency = strtoupper($request->currency);
        $data->buy = $request->buy;
        $data->sell = $request->sell;
        $data->save();
        return view('components.currency', compact('data'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrency $request, $code)
    {
        $validated = $request->validated();

        $data = Currency::where('currency', $code)->first();
        $data->currency = $request->currency;
        $data->buy = $request->buy;
        $data->sell = $request->sell;
        $data->save();

        return view('components.currency', compact('data'))->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $currency = Currency::where('currency', $code)->first();
        if($currency->delete()){
            $data = Currency::orderBy('currency', 'desc')->paginate(5);
            return view('components.currencies', compact('data'))->render();
        }
        return response(false);
    }

    public function history()
    {
        $data = Currency::with(['history' => function ($query){
                $query->orderBy('id', 'desc');
            }])->get();
        return response()->json($data);
    }
}
