<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCompanyToAddSoftDeleteField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_info', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
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
            if (Schema::hasColumn('deleted_at')) {
				Schema::table('company_info', function (Blueprint $table) {
					$this->dropColumn('deleted_at');
				});
			}
        });
    }
}
