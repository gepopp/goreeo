<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Http\Requests\NovaRequest;



class Image extends Resource {





    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Image::class;





    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';





    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            ID::make()->sortable(),
            Avatar::make( 'Titelbild' )
                  ->preview( function ( $model ) {

                      return $this->url;
                  } )
                  ->hideWhenCreating()
                  ->hideWhenUpdating()
                  ->squared(),

            \Laravel\Nova\Fields\Image::make( 'path' )
                                      ->store( function ( Request $request, $model ) {

                                          $this->setFileAttribute( $request['path']->getClientOriginalName() );

                                          $request['path']->storeAs( $this->folder, $this->file, 's3' );

                                          return true;

                                      } )
                                      ->preview( function () {

                                          if ( $this->path ) {
                                              return $this->path;
                                          }

                                          return false;
                                      } )
                                      ->deletable( false )
                                      ->hideFromIndex()
                                      ->hideFromDetail()
                                      ->hideWhenUpdating(),


            Text::make( 'Alt' )
                ->required()
                ->rules( [ 'required', 'string' ] )
                ->hideFromIndex(),
            Text::make( 'Copyright' )->hideFromIndex(),

            MorphTo::make( 'Attached' )->types( [
                References::class,
            ] )->nullable(),
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
