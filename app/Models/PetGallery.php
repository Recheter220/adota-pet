<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetGallery extends Model
{
    protected $fillable = [
        'pet_id',
        'path',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'path',
    ];

    protected $appends = [
        'url',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function getUrlAttribute()
    {
        return asset($this->attributes['path']);
    }
}
