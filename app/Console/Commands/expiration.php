<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire User Account Every 5 Minute Automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
       $users =  User::where("expire",0)->get(); // get all users active => 0 
       foreach ($users as $user) { // loop for each user active 
          $user->update(["expire" => "1"]); // edit each user 
       }

    }
}
