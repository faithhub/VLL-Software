<?php

namespace App\Http\Middleware;

use App\Models\SubHistory;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckSub
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
        $sub = SubHistory::find(Auth::user()->sub_id);
        if (empty($sub)) {
            User::where('id', Auth::user()->id)->update(['sub_id' => null]);
        } else {
            if (Carbon::now() > $sub->expired_date) {
                $sub->isActive = false;
                $sub->save();
            }
        }
        if (Auth::user()->team_id) {
            $team = Team::find(Auth::user()->team_id);
            if (Carbon::now() > $team->end_date) {
                $sub->sub_status = 'expired';
                $sub->save();
            }
        }
        return $next($request);
    }
}