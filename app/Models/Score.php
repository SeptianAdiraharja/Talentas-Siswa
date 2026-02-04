<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';

    protected $fillable = [
        'student_id',
        'criteria_id',
        'period_id',
        'value',
    ];

    /**
     * Relasi ke model Student (Siswa pemilik nilai)
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relasi ke model Criterion (Kriteria penilaian)
     */
    public function criterion()
    {
        return $this->belongsTo(Criterion::class, 'criteria_id');
    }

    /**
     * Relasi ke model Period (Periode penilaian)
     */
    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
