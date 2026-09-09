<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;
use CodeIgniter\CLI\CLI;

class ProduksiSeeder extends Seeder
{
    public function run()
    {
        CLI::write("Running user seeder");

        $userModel = new UserModel();

        $userData = [
            'id_company' => 1,
            'email_user' => 'produksi@gmail.com',
            'password_user' => password_hash("produksi123", PASSWORD_DEFAULT),
            'name_user' => 'Produksi',
            'phone_user' => '628574565895',
            'level_user' => 'produksi',
        ];

        $save = $userModel->save($userData);

        if (!$save) {
            CLI::write("Seeder failed", 'red');
        } else {
            CLI::write("Success seeding user", 'green');
        }
    }
}
