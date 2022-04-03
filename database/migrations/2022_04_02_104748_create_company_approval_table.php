<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_approval', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('user_id')->index('user_id')->nullable();
			$table->Integer('company_id')->nullable();
			$table->string('by_type')->nullable();
			$table->string('for_type')->nullable();
			$table->string('status')->nullable();
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
        Schema::dropIfExists('company_approval');
    }
}
