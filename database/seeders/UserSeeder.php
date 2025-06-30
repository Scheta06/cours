<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Array = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
                'role'     => 'admin',
                'password' => Hash::make('123123123'),
            ],
            [
                'name'     => 'User',
                'email'    => 'user@gmail.com',
                'role'     => 'user',
                'password' => Hash::make('123123123'),
            ],
        ];

        foreach ($Array as $item) {
            User::create($item);
        }
    }
}
