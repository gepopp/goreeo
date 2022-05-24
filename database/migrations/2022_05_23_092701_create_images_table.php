<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



return new class extends Migration {





    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create( 'images', function ( Blueprint $table ) {

            $table->id();
            $table->nullableMorphs('attached');
            $table->string( 'folder' );
            $table->string( 'file' );
            $table->string( 'url' )->nullable();
            $table->json( 'image_sizes' )->nullable();
            $table->text( 'srcset' )->nullable();
            $table->string( 'alt' )->nullable();
            $table->string( 'copyright' )->nullable();
            $table->integer( 'width' )->nullable();
            $table->integer( 'height' )->nullable();
            $table->timestamps();
        } );
    }





    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists( 'images' );
    }
};
