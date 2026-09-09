<?php

namespace App\Models;

use CodeIgniter\Model;

class DowntimeModel extends Model
{
    protected $table = 'tb_downtime';
    protected $primaryKey = 'id_downtime';

    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'code_downtime',
        'equipment_downtime',
        'date_start_downtime',
        'detail_downtime',
        'status_downtime',
        'date_done_downtime',
        'detail_done_downtime',
        'deleted_at',
    ];

    protected $useTimestamps = true;
}
