<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:create_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Очищает таблицу пользователей и создаёт новых';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        User::query()->delete();

        $usersData = config('custom_app.users_data');

        foreach ($usersData as $userData) {
            User::query()->create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);
        }

        return Command::SUCCESS;
    }
}
