<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RecreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP TABLE IF EXISTS posts');
        // Aquí puedes agregar más tablas si las tienes en tu base de datos

        $this->down();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No es necesario implementar el método down() para esta migración
    }
}
