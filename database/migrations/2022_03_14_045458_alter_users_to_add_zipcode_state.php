<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersToAddzipcodeState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->string('zipcode')->nullable()->after('user_type');
			$table->string('state')->nullable()->after('zipcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('zipcode,state')) {
				Schema::table('users', function (Blueprint $table) {
					$table->dropColumn('zipcode');
					$table->dropColumn('state');
				});
			}
        });
    }
}
