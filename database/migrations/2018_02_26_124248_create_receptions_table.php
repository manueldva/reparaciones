<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('equipment_id')->unsigned();
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade')->onUpdate('cascade');
            //$table->string('equipment', 128);
            $table->string('description', 512);
            $table->integer('reason_id')->unsigned();
            $table->foreign('reason_id')->references('id')->on('reasons')->onDelete('cascade')->onUpdate('cascade');
            $table->string('concept', 4000)->nullable();
            $table->enum('status',['WAITING', 'RECEIVED ', 'REPAIRING'])->default('WAITING');
            $table->string('file', 128)->nullable();
            //$table->string('email', 128)->nullable();
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
        Schema::dropIfExists('receptions');
    }
}
