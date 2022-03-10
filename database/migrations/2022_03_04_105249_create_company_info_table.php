<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
			$table->string('email');
            $table->string('address');
            $table->string('type');
			$table->string('catalog_first')->nullable();
			$table->string('catalog_second')->nullable();
			$table->string('catalog_third')->nullable();
			$table->string('catalog_four')->nullable();
			$table->string('catalog_five')->nullable();
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
        Schema::dropIfExists('company_info');
    }
}
