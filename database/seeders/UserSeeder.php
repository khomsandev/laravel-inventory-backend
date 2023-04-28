<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ลบข้อมูลเก่าออกไปก่อน insert data mockup
        DB::table('users')->delete();

        $data = [
            'fullname' => 'Khomsan Paphue',
            'username' => 'khomsan.pap',
            'email' => 'khomsan.pap@gmail.com',
            'password' => Hash::make('123456'),
            'tel' => '0812345678',
            'avatar' => 'https://via.placeholder.com/400x400.png/215732?text=SupperUser',
            'role' => '1',
            'remember_token' => 'ZAQWSXerhg'
        ];

        User::create($data);

        // ทำการเรียก UserFactory ที่จะทำการ Faker ข้อมูลให้
        User::factory(99)->create();
    }
}
