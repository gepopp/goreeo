<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class ContentBlock extends Model {





    use HasFactory;



    protected $guarded = [];





    protected $with = [ 'images' ];





    protected $casts = [ 'meta' => 'array' ];





    public function contentable() {

        return $this->morphTo();
    }





    public function getTitleAttribute( $value ) {

        if ( is_null( $value ) ) {
            return '';
        }

        return $value;
    }

    public function getSubtitleAttribute( $value ) {

        if ( is_null( $value ) ) {
            return '';
        }

        return $value;
    }





    public function images() {

        return $this->morphMany( Image::class, 'attached' );
    }
}
