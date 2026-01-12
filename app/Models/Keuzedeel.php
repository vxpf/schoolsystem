<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuzedeel extends Model
{
    use HasFactory;

    protected $table = 'keuzedelen';

    protected $fillable = [
        'naam',
        'beschrijving',
        'wat_leer_je',
        'code',
        'studiepunten',
        'niveau',
        'max_studenten',
        'min_studenten',
        'actief',
    ];

    protected $casts = [
        'actief' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'keuzedeel_user')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function getEnrolledStudentsCount()
    {
        return $this->users()->wherePivot('status', 'goedgekeurd')->count();
    }

    public function canStart()
    {
        return $this->getEnrolledStudentsCount() >= $this->min_studenten;
    }
}
