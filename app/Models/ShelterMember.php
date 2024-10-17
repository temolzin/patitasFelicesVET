<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ShelterMember extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia,SoftDeletes;

    protected $table = "shelter_member";
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'last_name', 'phone', 'email', 'state', 'city', 'colony' . 'address', 'postal_code', 'type_member', 'shelter_id'];
    const TYPE_MEMBER_STAFF = 'Personal';
    const TYPE_MEMBER_DONOR = 'Donante';
    const TYPE_MEMBER_GODFATHER = 'Padrino';
    const TYPE_MEMBER_ADOPTER = 'Adoptante';
    const TYPE_MEMBER = [self::TYPE_MEMBER_STAFF, self::TYPE_MEMBER_DONOR, self::TYPE_MEMBER_GODFATHER, self::TYPE_MEMBER_ADOPTER];

    protected $guarded = [];

    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'shelter_id');
    }

    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class, 'shelter_member_id');
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'shelter_member_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'shelter_member_id');
    }

    public function hasDependencies()
    {
        return $this->sponsorships()->exists() || 
            $this->adoptions()->exists() || 
            $this->donations()->exists();
    }
}
