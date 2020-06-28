<?php

namespace App\Console\Commands;

use App\Currency;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdatedCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updated Currencies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();
        $date = Carbon::today()->format('d.m.Y');
        $response = $client->request('GET', 'https://api.privatbank.ua/p24api/exchange_rates?json&date='.$date);
        $data = json_decode($response->getBody(), TRUE)['exchangeRate'];

        $currencies = Currency::all();

        $currencies->map(function ($currency) use($data){
            foreach ($data as $new_currency){
                if(!isset($new_currency['currency'])) continue;
                if($new_currency['currency'] == $currency->currency){
                    $currency->buy = $new_currency['purchaseRate'] ?? $new_currency['purchaseRateNB'];
                    $currency->sell = $new_currency['saleRate'] ?? $new_currency['saleRateNB'];
                    $currency->save();
                    break;
                }
            }
        });
    }
}
