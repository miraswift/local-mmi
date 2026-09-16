<?php

namespace App\Controllers;

use App\Models\DowntimeModel;

class Downtime extends BaseController
{
    protected $downtimeModel;

    public function __construct()
    {
        $this->downtimeModel = new DowntimeModel();
    }

    public function index()
    {
        $data['title'] = 'Downtime';
        $data['menuGroup'] = '';
        $data['menu'] = 'Downtime';

        $data['downtimes'] = $this->downtimeModel->orderBy('created_at', 'DESC')->findAll();

        return view('Downtime/Index', $data);
    }

    public function create()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'detail_downtime' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Detail wajib diisi',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/downtime')->withInput();
        }

        $downtimeData = [
            'equipment_downtime' => $vars['equipment_downtime'],
            'date_start_downtime' => date("Y-m-d H:i:s"),
            'detail_downtime' => $vars['detail_downtime'],
            'status_downtime' => 'Waiting',
        ];

        $save = $this->downtimeModel->save($downtimeData);

        if (!$save) {
            session()->setFlashdata('failed', 'Terjadi kesalahan, harap coba lagi');
            session()->setFlashdata('modalOpen', 'add-modal');
            return redirect()->to('/downtime')->withInput();
        } else {
            $date = date('d F Y');
            $time = date('H:i:s');
            $equipment = $vars['equipment_downtime'];
            $detail = $vars['detail_downtime'];

            $message = "🚨 UPDATE DOWNTIME REPORT 🚨 \n\n📅 Tanggal: $date \n⚙️ Equipment: $equipment \n📝 Detail Downtime: $detail \n⏰ Start Time (Sheet): $time \n⏱️ Waktu Update: $time WIB \n\nStatus: Dalam penanganan / terjadi perubahan detail.";

            $return = sendMessageDownimeAlarm($message);

            session()->setFlashdata('success', 'Berhasil menyimpan data' . json_encode($return));
            return redirect()->to('/downtime');
        }
    }

    public function update()
    {
        $vars = $this->request->getVar();

        if (!$this->validateData($vars, [
            'detail_done_downtime' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Detail wajib diisi',
                ]
            ]
        ])) {
            session()->setFlashdata('failed', 'Harap lengkapi form');
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_downtime']);
            return redirect()->to('/downtime')->withInput();
        }

        $downtime = $this->downtimeModel->where('id_downtime', $vars['id_downtime'])->first();

        $downtimeData = [
            'id_downtime' => $vars['id_downtime'],
            'status_downtime' => 'Done',
            'date_done_downtime' => date("Y-m-d H:i:s"),
            'detail_done_downtime' => $vars['detail_done_downtime'],
        ];

        $save = $this->downtimeModel->save($downtimeData);

        if (!$save) {
            session()->setFlashdata('failed', 'Terjadi kesalahan, harap coba lagi');
            session()->setFlashdata('modalOpen', 'edit-modal' . $vars['id_downtime']);
            return redirect()->to('/downtime')->withInput();
        } else {
            $date = date('d F Y', strtotime($downtime['date_start_downtime']));
            $time = date('H:i:s', strtotime($downtime['date_start_downtime']));
            $equipment = $downtime['equipment_downtime'];
            $detail = $downtime['detail_downtime'];
            $detailDone = $vars['detail_done_downtime'];
            $timeDone = date('H:i:s');

            $message = "✅ DOWNTIME SELESAI ✅ \n\n📅 Tanggal: $date \n⚙️ Equipment: $equipment \n📝 Detail Downtime: $detail \n \n📝 Detail Penyelesaian: $detailDone \n⏰ Start Time: $time \n🏁 Waktu Downtime: $timeDone \n\nStatus: Downtime telah selesai.";

            sendMessageDownimeAlarm($message);

            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/downtime');
        }
    }

    public function delete()
    {
        $vars = $this->request->getVar();

        $save = $this->downtimeModel->delete($vars['id_downtime']);

        if (!$save) {
            session()->setFlashdata('failed', 'Terjadi kesalahan, harap coba lagi');
            return redirect()->to('/downtime');
        } else {
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('/downtime');
        }
    }
}
