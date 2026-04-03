<?php

namespace App\Models;

use Database\Factories\PetFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int    id
 * @property string name
 * @property string species
 * @property string gender
 * @property string breed
 * @property string color
 * @property Carbon birthday
 * @property string bio
 * @property string picture
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
#[UseFactory(PetFactory::class)]
class Pet extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name', 'species', 'gender', 'breed', 'color', 'birthday', 'bio', 'picture',
    ];

    public function getPictureAttribute()
    {
        return asset('profile/' . $this->attributes['picture']);
    }
}
