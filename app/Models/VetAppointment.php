<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VetAppointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'animal_id',
        'schedule_date',
        'reason',
        'status',
        'observation'
    ];

    const PENDING ='Pendiente';
    const COMPLETED ='Finalizada'; 
    const CANCELED ='Cancelada';

    const APPOINTMENT_STATUS = [self::PENDING, self::COMPLETED, self::CANCELED];
    protected $dates = ['deleted_at'];

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function vetAppointments()
    {
        return $this->hasMany(VetAppointment::class, 'animal_id');
    }

    public function hasDependencies()
    {
        return $this->vetAppointments()->exists();
    }
}
