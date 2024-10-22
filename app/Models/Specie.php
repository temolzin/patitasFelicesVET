<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specie extends Model
{
    use SoftDeletes;

    protected $table = "species";
    protected $primaryKey= 'id';
    protected $fillable=['name','description','vet_id'];
    protected $guarded= [];
    
    public function vet()
    {
        return $this->belongsTo(Vet::class, 'vet_id');
    }

    public function hasDependencies()
    {
        return $this->animals()->exists();
    }

    public function animals()
    {
        return $this->hasMany(Animal::class, 'specie_id');
    }
}
