<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\NotifyEmail;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails for each users every Days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        // User::select("email")->get();
       $emails =  User::pluck("email")->toArray();
        foreach ($emails as $email ){
            # code... h>ow send emails
            $data = ["title" => "programming" , "body" => "PHP"] ;
            Mail::To($email)->send(new NotifyEmail($data));
            
        }
    }
}
