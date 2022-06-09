<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class ContentBlock extends Model {





    use HasFactory;



    protected $guarded = [];





    public function contentable() {

        return $this->morphTo();
    }





    public function images() {

        return $this->morphMany( Image::class, 'attached' );
    }
}
