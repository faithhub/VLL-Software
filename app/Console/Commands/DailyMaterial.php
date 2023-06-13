<?php

namespace App\Console\Commands;

use App\Mail\DailyMaterialMail;
use App\Models\Material;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyMaterial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyMaterialUpdate:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Material Update for the users via Email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $materials = Material::with(['type', 'cover'])->where('status', 'active')->whereMonth('created_at', '=', date('m'))->whereDay('created_at', '=', date('d'))->get();
        $users = User::where('role', 'user')->get('email');
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new DailyMaterialMail($materials));
        }
        $this->info('Daily Material Update for the users via Email has been sent successfully');
        // return Command::SUCCESS;
    }
}