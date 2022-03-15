<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersToAddExptotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->string('district')->nullable()->after('zipcode');
			$table->string('experience')->nullable()->after('district');
			$table->string('total_experience')->nullable()->after('experience');
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
            if (Schema::hasColumn('experience,total_experience')) {
				Schema::table('users', function (Blueprint $table) {
					$table->dropColumn('experience');
					$table->dropColumn('total_experience');
				});
			}
        });
    }
}
