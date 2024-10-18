<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'donation_date',
        'type',
        'amount',
        'observation'
    ]; 
    const MONEY ='Dinero';
    const SUPPLIES ='Insumos'; 

    const DONATION = [self::MONEY, self::SUPPLIES];
    protected $dates = ['delete'];

    public function vetMember()
    {
        return $this->belongsTo(VetMember::class, 'vet_member_id');
    }
}
