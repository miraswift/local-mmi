<?php

namespace App\Controllers;

use App\Models\EquipmentModel;
use App\Models\LogEquipmentModel;

class Additif extends BaseController
{
    protected $equipmentModel;
    protected $logEquimpentModel;

    public function __construct()
    {
        $this->equipmentModel = new EquipmentModel();
        $this->logEquimpentModel = new LogEquipmentModel();
    }

    public function create()
    {
        $vars = json_decode(json_encode($this->request->getVar()), true);

        $no_spk = $vars['no_spk'];
        $no_batch = $vars['no_spk'] . '-' . $vars['no_batch'];
        $no_batch_scanner = $vars['no_batch_scanner'];

        $equipmentData = [
            'no_batch_additif' => $no_batch_scanner,
        ];

        $this->equipmentModel->where('no_spk', $no_spk)->where('no_batch', $no_batch)->update(null, $equipmentData);
        $this->logEquimpentModel->where('no_spk', $no_spk)->where('no_batch', $no_batch)->update(null, $equipmentData);

        $result = [
            'code' => 200,
            'status' => 'ok',
            'msg' => "Additif saved sent",
        ];

        return $this->response->setStatusCode(200)->setJSON($result);
    }
}
