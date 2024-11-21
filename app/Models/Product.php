<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'created_by',
        'name',
        'description',
        'cost',
        'status',
        'amount',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_tables')->withPivot('quantity');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function inventories()
    {
        return $this->belongsToMany(Inventory::class)->withPivot('quantity');
    }
}
