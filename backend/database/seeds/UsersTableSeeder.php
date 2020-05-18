<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'first_name' => 'Connor',
            'last_name' => 'McGregor',
            'email' => 'c.mc.gregor@ireland.com',
            'phone' => 999999999,
            'role' => 'administrator'
        ]);
    }
}
