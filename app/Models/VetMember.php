<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class VetMember extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia,SoftDeletes;

    protected $table = "vet_member";
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'last_name', 'phone', 'email', 'state', 'city', 'colony' . 'address', 'postal_code', 'type_member', 'vet_id'];
    const TYPE_MEMBER_STAFF = 'Personal';
    const TYPE_MEMBER_DONOR = 'Donante';
    const TYPE_MEMBER_GODFATHER = 'Padrino';
    const TYPE_MEMBER_ADOPTER = 'Adoptante';
    const TYPE_MEMBER = [self::TYPE_MEMBER_STAFF, self::TYPE_MEMBER_DONOR, self::TYPE_MEMBER_GODFATHER, self::TYPE_MEMBER_ADOPTER];

    protected $guarded = [];

    public function vet()
    {
        return $this->belongsTo(Vet::class, 'vet_id');
    }

    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class, 'vet_member_id');
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'vet_member_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'vet_member_id');
    }

    public function hasDependencies()
    {
        return $this->sponsorships()->exists() || 
            $this->adoptions()->exists() || 
            $this->donations()->exists();
    }
}
