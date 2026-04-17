<?php

namespace App\Models;

use Database\Factories\PetFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int    $id
 * @property int    $organization_id
 * @property string $name
 * @property string $species
 * @property string $gender
 * @property string $breed
 * @property string $color
 * @property Carbon $birthday
 * @property string $bio
 * @property string $picture
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property Organization $organization
 * @property Collection<int, PetGallery> $gallery
 */
#[UseFactory(PetFactory::class)]
class Pet extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'organization_id', 'name', 'species', 'gender', 'breed', 'color', 'birthday', 'bio',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function gallery()
    {
        return $this->hasMany(PetGallery::class);
    }
}
