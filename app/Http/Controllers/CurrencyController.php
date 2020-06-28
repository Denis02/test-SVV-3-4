<?php

namespace App\Http\Controllers;

use App\Currency;
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
        $data = Currency::orderBy('currency', 'desc')->paginate(3);
        if($request->ajax())
        {
            return view('components.currencies', compact('data'))->render();
        }else{
            return view('welcome', compact('data'));
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
    public function store(Request $request)
    {
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
    public function update(Request $request, $code)
    {
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
            $data = Currency::orderBy('currency', 'desc')->paginate(3);
            return view('components.currencies', compact('data'))->render();
        }
        return response(false);
    }
}
