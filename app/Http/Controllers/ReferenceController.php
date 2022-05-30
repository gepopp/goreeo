<?php

namespace App\Http\Controllers;

use App\Models\Reference;



class ReferenceController extends Controller {





    public function slides() {

        $references = Reference::orderBy( 'slide_order', 'DESC' )->with( 'images' )->get();

        $data = [];

        foreach ( $references as $reference ) {


            $data[] = [
                'title'    => $reference->title,
                'subtitle' => $reference->subtitle,
                'image'    => $reference->images[0]->getSizeUrl( 'large' ),
                'color'    => $reference->color,
                'pos'      => $reference->bg_position
            ];


        }


        return $data;
    }


}
