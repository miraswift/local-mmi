<?php

namespace App\Controllers;

class Selector extends BaseController
{
    public function create()
    {
        $vars = json_decode(json_encode($this->request->getVar()), true);

        $date_selector = $vars['date_selector'];
        $time_selector = $vars['time_selector'];
        $status_selector = $vars['status_selector'];

        $message = "MEMASUKI MODE " . $status_selector . "\n\nWaktu: " . date('d F Y', strtotime($date_selector)) . " - " . $time_selector;

        sendMessageTelegram($message);

        $result = [
            'code' => 200,
            'status' => 'ok',
            'msg' => "Selector sent",
        ];

        return $this->response->setStatusCode(400)->setJSON($result);
    }
}
