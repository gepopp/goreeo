<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Reference extends Model {





    use HasFactory, HasSlug;



    protected $guarded = [];





    protected $with = [ 'contentBlocks' ];





    public function contentBlocks() {

        return $this->morphMany( ContentBlock::class, 'contentable' );
    }





    public function images() {

        return $this->morphMany( Image::class, 'attached' );
    }





    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions {

        return SlugOptions::create()
                          ->generateSlugsFrom( 'title' )
                          ->saveSlugsTo( 'slug' );
    }





    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName() {

        return 'slug';
    }

}
