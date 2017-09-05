<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BaseCommand extends Command
{
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
     * Exec sheel with pretty print.
     *
     * @param  string $command
     * @return mixed
     */
    public function execShellWithPrettyPrint($command)
    {
        $this->info('-- Start to install -');
        $this->info($command);
        $output = shell_exec($command);
        $this->info($output);
        $this->info('----');
    }
}
