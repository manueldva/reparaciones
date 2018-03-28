<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reception_id')->unsigned();
            $table->foreign('reception_id')->references('id')->on('receptions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('deliverDate');
            $table->decimal('workPrice',12,2)->default(0);
            $table->string('workDone', 4000);
            $table->string('file', 128)->nullable();
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
        Schema::dropIfExists('deliveries');
    }
}
