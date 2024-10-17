<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccine extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "vaccines";
    protected $primaryKey= 'vaccine_id';
    protected $fillable=['shelter_id','name','type','description'];
    protected $guarded= [];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'shelters_id');
    }

    public function vaccines()
    {
        return $this->hasMany(Vaccine::class); 
    }

    public function hasDependencies()
    {
        return $this->vetAppointments()->exists();
    }
}
