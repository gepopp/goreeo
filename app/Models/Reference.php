<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Reference extends Model {





    use HasFactory;



    protected $guarded = [];





    public function images() {

        return $this->morphMany( Image::class, 'attached' );
    }

}
