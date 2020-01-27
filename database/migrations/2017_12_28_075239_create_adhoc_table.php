<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdhocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adhoc', function (Blueprint $table) {
             $table->increments('id');
            $table->string('name');
            $table->string('gender');
            $table->string('mobile');
            $table->string('otp');
            $table->string('noadults');
            $table->string('person');
            $table->string('purpose');
            $table->string('events');
            $table->string('comment');
            $table->string('pic')->nullable();
            $table->date('logout')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adhoc');
    }
}
