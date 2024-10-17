<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VaccinatedAnimal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "vaccinated_animals";
    protected $primaryKey = 'id';
    protected $fillable = ['animal_id', 'vaccine_id', 'application_date'];
    protected $guarded = [];
    public $timestamps = true;

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function vaccines()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id');
    }
}
