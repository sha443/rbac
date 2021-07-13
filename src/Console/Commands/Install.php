<?php

namespace sha443\rbac\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

use sha443\rbac\Models\DummyUser;
use sha443\rbac\Models\UserRole;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rbac:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install RBAC package';

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
        echo "Warning!!! Warning!!! Warning!!!\nIt will migrate refresh!";

        $confirm = $this->ask('Are you sure? (Yes/No)');

        if($confirm=='Yes' || $confirm=='yes' || $confirm=='Y' || $confirm=='y')
        {

            echo "Migrating database\n";
            $response = Artisan::call('migrate:refresh');
            if($response==0)
            {
                echo "Migration complete\n\n";
            }

            echo "Seeding RBAC\n";
            $response = Artisan::call('db:seed',['--class'=>'\\sha443\\rbac\\database\\seeds\\RBACSeeder']);
            if($response==0)
            {
                echo "Db seeding completed! \nRoutes are converted to permissions\nPermissions & Menus are assigned to default role `admin``\n\n";
            }

            // Creating users
            echo "Create a user\n";
            while(empty($name))
            {
                $name = $this->ask('Enter your name:');
            }
            while(empty($email))
            {
                $email = $this->ask('Enter your email:');
            }
            while(empty($password))
            {
                $password = $this->ask('Enter a password:');
            }

            $user = DummyUser::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password)
            ]);

            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 1
            ]);

            echo "You are now an admin! Enjoy!\n\n";
        }

        else
        {
            echo "Installation cancelled";
        }

    }
}
