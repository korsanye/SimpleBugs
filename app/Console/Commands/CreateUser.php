<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:createuser 
                            {email : The email address of the new user} 
                            {password : A password to authenticate with} 
                            {--name= : Provide a name for the user }
                            {--admin= : true or false, defaults to false }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user for SimpleBugs';

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
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = "Admin";
        $is_admin = false;

        if (!is_null($this->option('name'))) {
            $name = $this->option('name');
        }

        if (!is_null($this->option('admin'))) {
            if (!in_array($this->option('admin'), ['true', 'false'])) {
                $this->error("--admin parameter value needs to be 'true' or 'false'.");
                return;
            }
            
            $is_admin = (boolean)$this->option('admin');
        }


        if (User::where('email', $email)->count() > 0) {
            $this->error('Email address already exists!');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("The {$email} email address is not considered valid.");
            return;
        }


        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->is_admin = $is_admin;

        $user->save();

        $this->info('User was created');
        return;

    }
}
