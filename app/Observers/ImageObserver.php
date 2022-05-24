<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as IntImage;



class ImageObserver {


    /**
     * Handle the Image "created" event.
     *
     * @param \App\Models\Image $image
     *
     * @return void
     */
    public function created( Image $image ) {

        $info = pathinfo( $image->path );

        $image->url = Storage::url( $image->path );

        $img = IntImage::make( $image->url );

        $image->width  = $img->getWidth();
        $image->height = $img->getHeight();

        $image->srcset = $image->url . ' ' . $img->getWidth() . 'w,';

        $files = [];

        foreach ( Image::IMAGE_SIZES as $sizename => $size ) {

            $img->resize( $size, null, function ( $constraint ) {

                $constraint->aspectRatio();
            } );

            $img->encode( $info['extension'] );

            $chunk   = explode( '.', $image->file );
            $storeAs = $image->folder . $chunk[0] . '_' . $sizename . '.' . $info['extension'];
            Storage::put( $storeAs, $img );

            $image->srcset .= Storage::url( $storeAs );
            $image->srcset .= ' ';
            $image->srcset .= $img->getWidth();
            $image->srcset .= 'w,';

            $files[ $sizename ] = $storeAs;

        }

        $image->srcset = rtrim( $image->srcset, ',' );

        $image->image_sizes = $files;

        $image->update();
    }





    /**
     * Handle the Image "deleted" event.
     *
     * @param \App\Models\Image $image
     *
     * @return void
     */
    public function deleted( Image $image ) {

        if ( is_array( $image->image_sizes ) ) {
            foreach ( $image->image_sizes as $size ) {
                if ( Storage::exists( $size ) ) {
                    Storage::delete( $size );
                }
            }
        }

        Storage::delete( $image->path );
    }


}
