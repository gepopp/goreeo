<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{







    protected $appends = [ 'path' ];





    protected $casts = [
        'image_sizes' => 'array',
    ];





    const IMAGE_SIZES = [
        'large'    => 1200,
        'medium'   => 600,
        'small'    => 300,
        'nl_small' => 272,
        'thumb'    => 120,
    ];





    public function setFolderAttribute() {

        $folder                     = 'photos/' . Carbon::now()->format( 'Ym' ) . '/';
        $this->attributes['folder'] = $folder;

    }





    public function setFileAttribute( $value ) {


        if ( empty( $this->folder ) ) {
            $this->setFolderAttribute();
        }

        $value = str_replace( ' ', '-', $value );

        $filenames = DB::table( 'images' )->where( 'folder', '=', $this->folder )->pluck( 'file' )->all();

        if ( in_array( $value, $filenames ) ) {
            $value = time() . '_' . $value;
        }

        $this->attributes['file'] = $value;
    }





    public function attached() {

        return $this->morphTo();
    }





    public function getPathAttribute() {

        return $this->folder . $this->file;
    }





    public function getSizeUrl( $size ) {

        if ( array_key_exists( $size, $this->image_sizes ) ) {
            return Storage::url( $this->image_sizes[ $size ] );
        }

        return Storage::url( $this->folder . $this->file );
    }}
