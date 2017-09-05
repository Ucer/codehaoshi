<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;

class BindAdmin extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bindAdmin:Ucer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bind Ucer to the role supper_admin';

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
        $this->info('-- Start... --');
        $supper_admin = Role::findOrFail(1);
        User::findOrFail(1)->attachRole($supper_admin);
        User::findOrFail(1)->update(['is_admin'=>'yes']);
        $this->info('-- The end --');
    }
}
