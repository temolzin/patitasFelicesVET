<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adoption extends Model 
{
    use HasFactory,SoftDeletes;
  
    protected $fillable = [
        'animal_id',
        'vet_member_id',
        'adoption_date',
        'observation',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function vetMember()
    {
        return $this->belongsTo(VetMember::class); 
    }
}
