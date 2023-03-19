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
    protected $signature = 'dailymaterial:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $materials = Material::whereMonth('date_of_birth', '=', date('m'))->whereDay('date_of_birth', '=', date('d'))->get();
        $users = User::where('role', 'user')->get('email');
        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new DailyMaterialMail($materials));
        }
        return Command::SUCCESS;
    }
}
