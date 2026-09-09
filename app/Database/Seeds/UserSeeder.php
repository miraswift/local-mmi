<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        CLI::write("Running user seeder");

        $userModel = new UserModel();

        $userData = [
            'id_company' => 1,
            'email_user' => 'superadmin@gmail.com',
            'password_user' => password_hash("Superadmin123+", PASSWORD_DEFAULT),
            'name_user' => 'Super Admin',
            'phone_user' => '6285546112267',
            'level_user' => 'superadmin',
        ];

        $save = $userModel->save($userData);

        if (!$save) {
            CLI::write("Seeder failed", 'red');
        } else {
            CLI::write("Success seeding user", 'green');
        }
    }
}
