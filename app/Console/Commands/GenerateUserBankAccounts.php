<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserBankAccount;
use Illuminate\Console\Command;

class GenerateUserBankAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:generate-bank-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate bank account details for users who do not have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::doesntHave('bankAccount')->get();
        
        $this->info("Found {$users->count()} users without bank accounts.");
        
        if ($users->count() === 0) {
            $this->info('All users already have bank accounts!');
            return 0;
        }
        
        $bar = $this->output->createProgressBar($users->count());
        $bar->start();
        
        foreach ($users as $user) {
            UserBankAccount::generateForUser($user);
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info("Successfully generated bank accounts for {$users->count()} users!");
        
        return 0;
    }
}
