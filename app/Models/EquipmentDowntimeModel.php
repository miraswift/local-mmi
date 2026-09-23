<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentDowntimeModel extends Model
{
    protected $table = 'tb_equipment_downtime';
    protected $primaryKey = 'id_equipment_downtime';

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name_equipment_downtime',
        'deleted_at',
    ];

    protected $useTimestamps = true;
}
