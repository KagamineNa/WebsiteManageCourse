<?php

namespace Modules\User\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\User\src\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Nguyen Ngoc Anh';
        $user->email = 'nguyenngocanh2622003@gmail.com';
        $user->password = Hash::make('123456');
        $user->group_id = 1;
        $user->save();
    }
}
