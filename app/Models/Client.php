<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey= 'id';
    protected $fillable = [
        'name',
        'last_name',
        'animal_id',
        'phone',
        'email',
        'state',
        'city',
        'colony',
        'address',
        'postal_code',
        'observations',
    ];
    
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
    
    public function animals()
    {
        return $this->hasMany(Animal::class, 'client_id', 'id');
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
