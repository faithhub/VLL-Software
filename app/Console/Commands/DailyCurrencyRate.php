<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class DailyCurrencyRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyCurrencyRateUpdate:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily currency rate update from Flutterwave API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currencies = Currency::whereNot('code', 'NGN')->get();;
        foreach ($currencies as $key => $currency) {
            # code...
            $secret = Config::get('services.flutterwave.secret');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $secret
            ])->get('https://api.flutterwave.com/v3/transfers/rates?amount=1&destination_currency=' . $currency->code . '&source_currency=NGN');
            $res = $response->json();
            if ($res['status'] == "success") {
                $currency->rate = $res['data']['rate'];
                $currency->updated_at = Carbon::now();
                $currency->save();
            }
        }
        $this->info('12 Hours Currency Rate Update has been sent successfully');
    }
}
