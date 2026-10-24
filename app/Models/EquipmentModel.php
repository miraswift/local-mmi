<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
    protected $table = 'tb_equipment';
    protected $primaryKey = 'id_equipment';

    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_plant', 'type_equipment', 'no_spk', 'no_batch', 'code_formula', 'name_equipment', 'status_equipment', 'line_equipment', 'date_equipment', 'time_equipment', 'duration_equipment', 'target_equipment', 'actual_equipment', 'deleted_at', 'mode_equipment', 'name_product', 'no_batch_additif'];

    protected $useTimestamps = true;


    public function getBatchNumberGroup($dateFrom, $dateTo)
    {
        $this->where('date_equipment >=', $dateFrom);
        $this->where('date_equipment <=', $dateTo);
        $this->groupBy('no_batch');
        $this->orderBy('no_batch', 'DESC');

        return $this->findAll();
    }

    public function getBatchNumberGroupByDateAndHour($date, $timeFrom, $timeTo)
    {
        $this->where('name_equipment', 'MIXING');
        $this->where('date_equipment', $date);
        $this->where('HOUR(time_equipment) >=', $timeFrom);
        $this->where('HOUR(time_equipment) <=', $timeTo);
        $this->groupBy('no_batch');
        $this->orderBy('no_batch', 'DESC');

        return $this->findAll();
    }

    public function getBatchNumberGroupBySpk($no_spk)
    {
        $this->where('no_spk', $no_spk);
        $this->groupBy('no_batch');
        $this->orderBy('time_equipment', 'DESC');

        return $this->findAll();
    }

    public function getSpkGroup($dateFrom, $dateTo)
    {
        $this->where('date_equipment >=', $dateFrom);
        $this->where('date_equipment <=', $dateTo);
        $this->groupBy('no_spk');
        $this->orderBy('created_at', 'DESC');

        return $this->findAll();
    }

    public function getSpkGroupByNoSpk($no_spk)
    {
        $this->where('no_spk', $no_spk);
        $this->groupBy('no_spk');
        $this->orderBy('created_at', 'DESC');

        return $this->first();
    }

    public function getDossingFirst($no_spk, $no_batch)
    {
        $this->select('MIN(id_equipment) AS id_equipment');
        $this->where('type_equipment', 'DOSSING');
        $this->where('status_equipment', 'ON');
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDossingLast($no_spk, $no_batch)
    {
        $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('type_equipment', 'DOSSING');
        $this->where('status_equipment', 'OFF');
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDossingPowderFirst($no_spk, $no_batch)
    {
        $this->select('MIN(id_equipment) AS id_equipment');
        $this->where('type_equipment', 'DOSSING');
        $this->where('status_equipment', 'ON');
        $this->whereIn('name_equipment', ['FEEDING SEMEN GREY', 'FEEDING SEMEN PUTIH', 'FEEDING KAPUR']);
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDossingPowderLast($no_spk, $no_batch)
    {
        $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('type_equipment', 'DOSSING');
        $this->where('status_equipment', 'OFF');
        $this->whereIn('name_equipment', ['FEEDING SEMEN GREY', 'FEEDING SEMEN PUTIH', 'FEEDING KAPUR']);
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDossingPasirFirst($no_spk, $no_batch)
    {
        $this->select('MIN(id_equipment) AS id_equipment');
        $this->where('type_equipment', 'DOSSING');
        $this->where('status_equipment', 'ON');
        $this->whereIn('name_equipment', ['FEEDING PASIR KASAR', 'FEEDING PASIR HALUS']);
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDossingPasirLast($no_spk, $no_batch)
    {
        $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('type_equipment', 'DOSSING');
        $this->where('status_equipment', 'OFF');
        $this->whereIn('name_equipment', ['FEEDING PASIR KASAR', 'FEEDING PASIR HALUS']);
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getWeighingDischargeFirst($no_spk, $no_batch)
    {
        $this->select('MIN(id_equipment) AS id_equipment');
        $this->whereIn('name_equipment', ['DISSCHARGE POWDER', 'DISSCHARGE PASIR']);
        $this->where('status_equipment', 'ON');
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getWeighingDischargeLast($no_spk, $no_batch)
    {
        $this->select('MAX(id_equipment) AS id_equipment');
        $this->whereIn('name_equipment', ['DISSCHARGE POWDER', 'DISSCHARGE PASIR']);
        $this->where('status_equipment', 'OFF');
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDischargeOn($no_spk, $no_batch)
    {
        // $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('name_equipment', 'WEIGHING DISCHARGE');
        $this->where('status_equipment', 'ON');
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getMixingOn($no_spk, $no_batch)
    {
        // $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('name_equipment', 'MIXING');
        $this->where('status_equipment', 'ON');
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }

    public function getDischargeUhOff($no_spk, $no_batch)
    {
        // $this->select('MAX(id_equipment) AS id_equipment');
        $this->where('name_equipment', 'DISSCHARGE UNDERHOPPER');
        $this->where('status_equipment', 'OFF');
        $this->where('no_spk', $no_spk);
        $this->where('no_batch', $no_batch);

        return $this->first();
    }
}
