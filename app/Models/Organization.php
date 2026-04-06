<?php

namespace App\Models;

use Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int              id
 * @property string           name
 * @property string           slug
 * @property string           description
 * @property string           email
 * @property string           website
 * @property string           phone
 * @property string           address
 * @property string           logo_path
 * @property bool             verified
 * @property Collection<Pet>  pets
 */
#[UseFactory(OrganizationFactory::class)]
class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory;

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
