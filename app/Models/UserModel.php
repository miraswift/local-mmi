<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id_company',
        'email_user',
        'password_user',
        'name_user',
        'phone_user',
        'level_user',
        'deleted_at',
    ];

    protected $useTimestamps = true;
}
