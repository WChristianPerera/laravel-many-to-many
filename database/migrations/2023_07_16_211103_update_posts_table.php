<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // creare la colonna della chiave esterna
            $table->unsignedBigInteger('category_id')->after('id')->default('1'); //->nullable();

            // definire la colonna come chiave esterna
            $table->foreign('category_id')->references('id')->on('categories'); //->nullOnDelete(); ->onDelete('cascade');
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
            // eliminare la chiave esterna
            $table->dropForeign('posts_category_id_foreign');

            // eliminare la colonna
            $table->dropColumn('category_id');
        });
    }
};