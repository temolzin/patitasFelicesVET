<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cost',
        'description',
        'animal_id',
        'availability',
        'duration', 
    ];

    public function animals()
    {
        return $this->belongsToMany(Animal::class, 'animal_service');
    }

    public function vet()
    {
        return $this->belongsTo(Vet::class, 'vets_id');
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

}
