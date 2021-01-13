<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldstoTicketstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            
            $table->unsignedInteger('status_id')->nullable()->references('id')->on('statuses');

            $table->unsignedInteger('priority_id')->nullable()->references('id')->on('priorities');

            $table->unsignedInteger('handler_user_id')->nullable()->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
        });
    }
}
