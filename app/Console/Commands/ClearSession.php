<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearSession extends Command
{
    // The name and signature of the console command
    protected $signature = 'session:clear';

    // The console command description
    protected $description = 'Clear all session data';

    // Execute the console command
    public function handle()
    {
        session()->flush();
        session()->regenerate();
        $this->info('Session data cleared successfully.');
    }
}
