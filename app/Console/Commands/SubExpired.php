<?php

namespace App\Console\Commands;

use App\Mail\ExpiredSubEmail;
use App\Models\SubHistory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SubExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sub:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send an email to user whose subscription has expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subs = SubHistory::where(["isActive" => false, 'isEmailSent' => false])->with('user')->get();
        foreach ($subs as $sub) {
            Mail::to($sub->user->email)->send(new ExpiredSubEmail($sub->user->name));
            $sub->isEmailSent = true;
            $sub->save();
        }
        // return 0;
    }
}