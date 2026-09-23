<?php

namespace App\Controllers;

use App\Models\EquipmentDowntimeModel;
use CodeIgniter\Model;

class EquipmentDowntime extends BaseController
{
    protected $equipmentDowntimeModel;

    public function __construct()
    {
        $this->equipmentDowntimeModel = new EquipmentDowntimeModel();
    }

    public function index()
    {
        $data['title'] = 'Equipment Downtime';
        $data['menuGroup'] = '';
        $data['menu'] = 'EquipmentDowntime';

        $data['equipmentDowntimes'] = $this->equipmentDowntimeModel->orderBy('created_at', 'DESC')->findAll();

        return view('EquipmentDowntime/Index', $data);
    }

    public function create()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'name_equipment_downtime' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/equipment-downtime')->withInput();
        }

        $equipmentDowntimeData = [
            'name_equipment_downtime' => $vars['name_equipment_downtime'],
        ];

        $save = $this->equipmentDowntimeModel->save($equipmentDowntimeData);

        if (!$save) {
            session()->setFlashdata('failed', 'Terjadi kesalahan, harap coba lagi');
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/equipment-downtime')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/equipment-downtime');
        }
    }

    public function update()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'id_equipment_downtime' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Id wajib diisi.',
                    'numeric' => 'Id tidak sesuai'
                ]
            ],
            'name_equipment_downtime' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_equipment_downtime']);
            return redirect()->to('/equipment-downtime')->withInput();
        }

        $equipmentDowntimeData = [
            'id_equipment_downtime' => $vars['id_equipment_downtime'],
            'name_equipment_downtime' => $vars['name_equipment_downtime'],
        ];

        $save = $this->equipmentDowntimeModel->save($equipmentDowntimeData);

        if (!$save) {
            session()->setFlashdata('failed', 'Terjadi kesalahan, harap coba lagi');
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_equipment_downtime']);
            return redirect()->to('/equipment-downtime')->withInput();
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/equipment-downtime');
        }
    }

    public function delete()
    {
        $vars = $this->request->getVar();

        $save = $this->equipmentDowntimeModel->delete($vars['id_equipment_downtime']);

        if (!$save) {
            session()->setFlashdata('failed', 'Terjadi kesalahan, harap coba lagi');
            return redirect()->to('/equipment-downtime');
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/equipment-downtime');
        }
    }
}
