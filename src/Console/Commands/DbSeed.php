<?php

namespace sha443\rbac\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class DbSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rbac:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding from RBAC package';

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
        $response = Artisan::call('db:seed',['--class'=>'\\sha443\\rbac\\database\\seeds\\RBACSeeder']);
        if($response==0)
        {
            echo "Db seeding completed! \nRoutes are converted to permissions\nPermissions & Menus are assigned to default role `admin``";
        }
    }
}
