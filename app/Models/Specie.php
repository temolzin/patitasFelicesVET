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
    protected $fillable=['name','description','shelter_id'];
    protected $guarded= [];
    
    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'shelter_id');
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
