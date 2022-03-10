<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCompanyToAddUserIdField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_info', function (Blueprint $table) {
             $table->unsignedBigInteger('user_id')->after('id');
			 $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_info', function (Blueprint $table) {
            //
        });
		Schema::table('company_info', function (Blueprint $table) {
            if (Schema::hasColumn('user_id')) {
				Schema::table('company_info', function (Blueprint $table) {
					$table->dropColumn('user_id');
				});
			}
        });
    }
}
