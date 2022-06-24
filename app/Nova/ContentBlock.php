<?php

namespace App\Nova;

use Manogi\Tiptap\Tiptap;
use Laravel\Nova\Fields\Text;
use App\Traits\TipTapSettings;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Http\Requests\NovaRequest;



class ContentBlock extends Resource {





    use TipTapSettings;



    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ContentBlock::class;





    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';





    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'subtitle',
        'content',
    ];





    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function fields( NovaRequest $request ) {

        return [
            MorphTo::make( 'Contentable', 'contentable' )
                   ->types( [
                       References::class,
                   ] ),

            Number::make( 'Order' )->rules( [ 'required', 'integer' ] )->default( 100 ),

            Select::make( 'Layout' )
                  ->options( [
                      'image'   => 'Nur Bild',
                      'images'  => 'Zwei Bilder',
                      'meta'    => 'Metadatenblock',
                      'text'    => 'Nur Text',
                      'row'     => 'Text/Bild',
                  ] )
                  ->default( 'default' ),

            Select::make( 'Color Scheme', 'color' )
                  ->options( [
                      'logo'  => 'logo',
                      'white' => 'white',
                  ] )
                  ->default( 'logo' ),

            Text::make( 'Title' )
                ->rules( [ 'required', 'string' ] ),

            Text::make( 'Subtitle' )
                ->nullable()
                ->rules( [ 'string', 'nullable' ] ),


            Tiptap::make( 'Inhalt', 'content' )
                  ->alwaysShow()
                  ->buttons( $this->TipTapButtons() )
                  ->headingLevels( [ 2, 3, 4 ] )
                  ->imageSettings( [
                      'disk' => 's3',
                      'path' => 'images/articles',
                  ] ),


            KeyValue::make('Meta')->nullable(),

            MorphMany::make( 'Images', 'images', 'App\Nova\Image' ),

        ];
    }





    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function cards( NovaRequest $request ) {

        return [];
    }





    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function filters( NovaRequest $request ) {

        return [];
    }





    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function lenses( NovaRequest $request ) {

        return [];
    }





    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function actions( NovaRequest $request ) {

        return [];
    }
}
