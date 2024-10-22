<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vet extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $table = 'vets';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'facebook',
        'tiktok',
        'state',
        'city',
        'colony',
        'address',
        'postal_code'
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hasDependencies()
    {
        return $this->users()->exists();
    } 
}
