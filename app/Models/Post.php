<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    const STATUS_DRAFT = 'draft';
    const STATUS_UNPUBLISHED = 'unpublished';
    const STATUS_PUBLISHED = 'published';

    protected $table = 'posts';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $fillale = [
        'title',
        'content',
        'posted_at',
        'status',
        'category_id',
        'thumb_id',
        '_token'
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('post')->
            registerMediaConversions(function (Media $media) {
            $this
                ->addMediaConversion('thumb')
                ->width(682)
                ->height(453);

            $this->addMediaConversion('square')
                ->width(900)
                ->height(600);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getThumb(){
        return $this->belongsTo(MediaLibrary::class,'thumb_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
