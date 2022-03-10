<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersToAddStripe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->tinyInteger('is_admin')->default('0')->after('remember_token');
			$table->string('user_type')->nullable()->after('is_admin');
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
            if (Schema::hasColumn('is_admin,user_type')) {
				Schema::table('users', function (Blueprint $table) {
					$table->dropColumn('is_admin');
					$table->dropColumn('user_type');
				});
			}
        });
    }
}
