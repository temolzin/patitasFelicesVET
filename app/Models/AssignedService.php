<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignedService extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "applied_services";
    protected $primaryKey = 'id';
    protected $fillable = ['animal_id', 'service_id', 'service_date'];
    protected $guarded = [];
    public $timestamps = true;

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
