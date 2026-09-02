<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'admin:create {--email=admin@nere-mining.com} {--password=NereAdmin2024!} {--name=Administrateur}';

    /**
     * The console command description.
     */
    protected $description = 'Create or update admin user for Néré Mining';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name') . ' Néré Mining';

        try {
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make($password),
                    'is_admin' => true,
                    'email_verified_at' => now(),
                ]
            );

            $this->info('✅ Admin user created/updated successfully!');
            $this->info('📧 Email: ' . $user->email);
            $this->info('🆔 ID: ' . $user->id);
            $this->info('👤 Name: ' . $user->name);
            $this->info('🔑 Password: ' . $password);

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Failed to create admin user: ' . $e->getMessage());
            
            // Diagnostics supplémentaires
            $this->info('🔍 Database diagnostics:');
            $this->info('Connection: ' . config('database.default'));
            $this->info('Driver: ' . config('database.connections.' . config('database.default') . '.driver'));
            
            return Command::FAILURE;
        }
    }
}