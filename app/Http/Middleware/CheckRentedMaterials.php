<?php

namespace App\Http\Middleware;

use App\Models\MaterialHistory;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRentedMaterials
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $expired_data = Carbon::now();
        $expired_data->addDays(2);
        $materials = MaterialHistory::where(['user_id' => Auth::user()->id, 'type' => 'rented'])->whereDate('created_at', '<=', Carbon::now()->subDays(2)->toDateTimeString())->get();
        foreach ($materials as $key => $value) {
            # code...
            $value->is_rent_expired = true;
            $value->save();
        }
        return $next($request);
    }
}