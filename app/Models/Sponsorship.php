<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsorship extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "sponsorship";
    protected $primaryKey= 'id';
    protected $fillable=['animal_id', 'shelter_member_id','start_date','finish_date','payment_date','amount','observation'];
    protected $guarded= [];
    
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function shelterMember()
    {
        return $this->belongsTo(ShelterMember::class, 'shelter_member_id');
    }
    
}
