<?php

namespace App\Http\Controllers;

use App\Models\Reference;



class ReferenceController extends Controller {





    public function show( Reference $reference ) {

        sleep(2);

        return inertia( 'ReferenceShow', [
            'reference' => $reference,
        ] );
    }





    public function slides() {



        $references = Reference::orderBy( 'slide_order', 'DESC' )->with( 'images' )->get();

        $data = [];

        foreach ( $references as $reference ) {


            $data[] = [
                'slug'     => $reference->slug,
                'title'    => $reference->title,
                'subtitle' => $reference->subtitle,
                'image'    => $reference->images[0]->getSizeUrl( 'large' ),
                'color'    => $reference->color,
                'pos'      => $reference->bg_position,
            ];


        }


        return $data;
    }


}
