<?php

use Illuminate\Database\Seeder;
use App\Models\User;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(User::class, 10)->create();
        factory(User::class, 1)->create([
            'first_name' => 'Admin',
            'last_name' => 'McGregor',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'phone' => 999999999,
            'role' => 'administrator'
        ]);
    }
}
