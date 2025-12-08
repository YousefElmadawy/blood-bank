<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssignRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-role
                            {email? : The email of the user}
                            {role? : The role to assign}
                            {--list : List all users with their roles}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a user or list all users with roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // List all users with their roles
        if ($this->option('list')) {
            return $this->listUsers();
        }

        $email = $this->argument('email');
        $roleName = $this->argument('role');

        // Interactive mode if no arguments provided
        if (!$email) {
            $email = $this->ask('Enter user email');
        }

        if (!$roleName) {
            $roles = Role::pluck('name')->toArray();
            $roleName = $this->choice('Select a role', $roles);
        }

        // Find user
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");

            if ($this->confirm('Would you like to see all users?')) {
                $this->listUsers();
            }

            return Command::FAILURE;
        }

        // Check if role exists
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $this->error("Role '{$roleName}' does not exist.");
            $this->info('Available roles: ' . Role::pluck('name')->join(', '));
            return Command::FAILURE;
        }

        // Assign role
        $user->assignRole($roleName);

        $this->info("✓ Role '{$roleName}' assigned to {$user->name} ({$user->email})");
        $this->line('Current roles: ' . $user->getRoleNames()->join(', '));

        return Command::SUCCESS;
    }

    /**
     * List all users with their roles
     */
    protected function listUsers()
    {
        $users = User::with('roles')->get();

        if ($users->isEmpty()) {
            $this->warn('No users found in the database.');
            return Command::SUCCESS;
        }

        $this->info('All Users and Their Roles:');
        $this->line('');

        $tableData = $users->map(function ($user) {
            return [
                'ID'    => $user->id,
                'Name'  => $user->name,
                'Email' => $user->email,
                'Roles' => $user->getRoleNames()->join(', ') ?: 'No roles',
            ];
        })->toArray();

        $this->table(
            ['ID', 'Name', 'Email', 'Roles'],
            $tableData
        );

        return Command::SUCCESS;
    }
}
