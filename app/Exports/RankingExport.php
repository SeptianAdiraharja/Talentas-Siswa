<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Admin\RankingController;

class RankingExport implements FromCollection, WithHeadings
{
    protected $period_id;

    public function __construct($period_id) {
        $this->period_id = $period_id;
    }

    public function collection()
    {
        $rankingData = (new RankingController())->calculateRanking($this->period_id);
        $results = $rankingData['results'];
        $criteria = $rankingData['criteria'];

        return collect($results)->map(function($row, $index) use ($criteria) {
            $data = [
                'No' => $index + 1,
                'NIS' => $row['student']->nis,
                'Nama' => $row['student']->user->name,
            ];

            foreach ($criteria as $c) {
                $data[$c->name] = $row['normalized_scores'][$c->id];
            }

            $data['Nilai V'] = $row['value'];
            $data['Ranking'] = $index + 1;

            return $data;
        });
    }

    public function headings(): array {
        return ["Ranking", "Nama Siswa", "NIS", "Nilai Preferensi", "Keterangan"];
    }
}