<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run necessary installations (composer, .env file, migrations and seeders)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Installing composer dependencies...');
        exec('composer install');

        $this->info('Copying .env.example to .env...');
        if (!file_exists('.env')) {
            copy('.env.example', '.env');
        }

        $this->info('Generating app key...');
        Artisan::call('key:generate');

        $this->info('Running migrations...');
        Artisan::call('migrate');

        $this->info('Running seeders...');
        Artisan::call('db:seed');

        $this->info('Project installed successfully.');

        return 0;
    }
}
