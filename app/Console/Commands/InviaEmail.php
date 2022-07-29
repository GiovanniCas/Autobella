<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\EmailSettimanale;
use Illuminate\Console\Command;
use App\Console\Commands\InviaEmail;
use Illuminate\Support\Facades\Mail;

class InviaEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messaggio:settimanale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to send weekly message';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('ruolo' , User::GESTORE)->get();
        foreach($users as $user ){
            $nome = $user->name;
            Mail::to($user->email)->send(new EmailSettimanale($nome));
          
        }
        // return view('mails.emailSettimanale' , compact('name'));
    }
}
