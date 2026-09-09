<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\CLI\CLI;

class MaintenSeeder extends Seeder
{
    public function run()
    {
        CLI::write("Running user seeder");

        $userModel = new UserModel();

        $userData = [
            'id_company' => 1,
            'email_user' => 'maintennance@gmail.com',
            'password_user' => password_hash("maintennance123", PASSWORD_DEFAULT),
            'name_user' => 'Maintennance',
            'phone_user' => '628574565895',
            'level_user' => 'maintennance',
        ];

        $save = $userModel->save($userData);

        if (!$save) {
            CLI::write("Seeder failed", 'red');
        } else {
            CLI::write("Success seeding user", 'green');
        }
    }
}
