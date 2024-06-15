<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Sluggable, SluggableScopeHelpers, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];
    
    protected $fillable = [
        'post_author','post_content','post_title','featured_image','slug','post_excerpt','post_status','comment_status','post_parent','post_type', 'post_mime_type','comment_count'
    ];

    public function media()
    {
        return $this->hasOne(Media::class, 'id','featured_image');
	}

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }
}
