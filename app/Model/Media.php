<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'type', 'name', 'added_by', 'url', 'path', 'description', 'parent', 'image_size', 'height', 'width', 'kilobyte', 'deleted',
    ];

    public function children()
    {
        return $this->hasMany(Media::class, 'parent');
    }
}
