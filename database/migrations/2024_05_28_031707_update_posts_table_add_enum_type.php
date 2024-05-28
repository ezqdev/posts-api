<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTableAddEnumType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->enum('type', [
                'Real estate events',
                'Classroom courses',
                'Webinars',
                'Legal updates',
                'News Mundoinmobilario.tv',
                'Promotions',
                'Publicity'
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Si es necesario revertir los cambios, aquí puedes hacerlo.
            // Sin embargo, en este caso, al añadir un enum, no hay una reversión sencilla y segura.
        });
    }
}
