<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'status',
        'payment_method',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_tables')->withPivot('quantity', 'service_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'store_tables')->withPivot('quantity');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
