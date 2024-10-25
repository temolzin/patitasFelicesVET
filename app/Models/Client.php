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
        'phone',
        'email',
        'state',
        'city',
        'colony',
        'address',
        'postal_code',
        'number_pets',
        'observations',
    ];
    
    public function animals()
    {
        return $this->hasMany(Animal::class, 'client_id');
    }
}
