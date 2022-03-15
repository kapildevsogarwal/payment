<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCompanyToAddDistStateZipField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_info', function (Blueprint $table) {
            $table->string('district')->nullable()->after('gst');
			$table->string('state')->nullable()->after('district');
			$table->string('zip')->nullable()->after('district');
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
            if (Schema::hasColumn('district,state,zip')) {
				Schema::table('company_info', function (Blueprint $table) {
					$table->dropColumn('district');
					$table->dropColumn('state');
					$table->dropColumn('zip');
				});
			}
        });
    }
}
