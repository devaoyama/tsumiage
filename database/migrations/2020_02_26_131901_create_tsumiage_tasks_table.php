<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsumiageTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsumiage_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tsumiage_date_id')->unsigned();
            $table->string('title');
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('tsumiage_date_id')->references('id')->on('tsumiage_dates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tsumiage_tasks');
    }
}
