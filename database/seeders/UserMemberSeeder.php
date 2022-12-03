<?php

namespace Database\Seeders;

use App\Constants\GenderConstant;
use App\Constants\RolesConstant;
use App\Models\Division;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createUser = User::create([
            'name' => 'member',
            'email' => 'member@member.com',
            'phone' => '083852413038',
            'password' => Hash::make('123123'),
            'roles' => RolesConstant::MEMBER,
        ]);

        Member::create([
            'user_id' => $createUser->id,
            'division_id' => Division::first()->id,
            'name' => 'member',
            'gender' => GenderConstant::MALE,
            'address' => 'Malang',
            'nip' => '201910370311032'
        ]);
    }
}
