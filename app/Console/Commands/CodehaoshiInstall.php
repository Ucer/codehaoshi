<?php

namespace App\Console\Commands;


class CodehaoshiInstall extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'codehaoshi:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First install the website';

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
        $this->execShellWithPrettyPrint('php artisan key:generate');
        $this->execShellWithPrettyPrint('php artisan migrate');
        $this->execShellWithPrettyPrint('php artisan passport:install');
        $this->execShellWithPrettyPrint('php artisan db:seed --class=RolesTableSeeder');
        $this->execShellWithPrettyPrint('php artisan db:seed --class=PermissionsTableSeeder');
    }


}
