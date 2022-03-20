<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('user_id')->index('user_id')->nullable();
            $table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('father_name')->nullable();
			$table->string('mother_name')->nullable();
            $table->string('address')->nullable();
			$table->string('district')->nullable();
			$table->string('state')->nullable();
            $table->string('zip')->nullable();
			$table->string('type')->nullable();
			$table->string('description')->nullable();
			$table->string('experience')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional');
    }
}
