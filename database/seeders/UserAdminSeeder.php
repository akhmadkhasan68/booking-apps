<?php

namespace Database\Seeders;

use App\Constants\GenderConstant;
use App\Constants\RolesConstant;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createUser = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '081252345455',
            'password' => Hash::make('123123'),
            'roles' => RolesConstant::ADMIN,
        ]);

        Admin::create([
            'user_id' => $createUser->id,
            'name' => 'admin',
            'gender' => GenderConstant::MALE,
            'address' => 'Malang',
            'nip' => '201910370311032'
        ]);
    }
}
