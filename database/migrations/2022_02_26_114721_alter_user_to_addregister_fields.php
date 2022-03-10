<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserToAddregisterFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
			$table->string('last_name')->nullable()->after('first_name');
			$table->string('dob')->nullable()->after('last_name');
			$table->string('user_photo')->nullable()->after('password');
			$table->string('address')->nullable()->after('user_photo');
			$table->string('aadhar_card')->nullable()->after('address');
			$table->string('aadhar_card_back')->nullable()->after('aadhar_card');
			$table->string('father_name')->nullable()->after('aadhar_card_back');
			$table->string('mother_name')->nullable()->after('father_name');
			$table->string('tenth_board_name')->nullable()->after('mother_name');
			$table->string('tenth_year_name')->nullable()->after('tenth_board_name');
			$table->string('tenth_percentage')->nullable()->after('tenth_year_name');
			$table->string('twelth_board_name')->nullable()->after('tenth_percentage');
			$table->string('twelth_year_name')->nullable()->after('twelth_board_name');
			$table->string('twelth_percentage')->nullable()->after('twelth_year_name');
			$table->string('degree_diploma')->nullable()->after('twelth_percentage');
			$table->string('degree_diploma_year')->nullable()->after('degree_diploma');
			$table->string('degree_diploma_percentage')->nullable()->after('degree_diploma_year');
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
            if (Schema::hasColumn('first_name,last_name,dob,user_photo,address,aadhar_card,aadhar_card_back,father_name,mother_name,tenth_board_name,tenth_year_name,tenth_percentage,twelth_board_name,twelth_year_name,twelth_percentage,degree_diploma,degree_diploma_year,degree_diploma_percentage')) {
				Schema::table('users', function (Blueprint $table) {
					$table->dropColumn('first_name');
					$table->dropColumn('last_name');
					$table->dropColumn('dob');
					$table->dropColumn('user_photo');
					$table->dropColumn('address');
					$table->dropColumn('aadhar_card');
					$table->dropColumn('aadhar_card_back');
					$table->dropColumn('father_name');
					$table->dropColumn('mother_name');
					$table->dropColumn('tenth_board_name');
					$table->dropColumn('tenth_year_name');
					$table->dropColumn('tenth_percentage');
					$table->dropColumn('twelth_board_name');
					$table->dropColumn('twelth_year_name');
					$table->dropColumn('twelth_percentage');
					$table->dropColumn('degree_diploma');
					$table->dropColumn('degree_diploma_year');
					$table->dropColumn('degree_diploma_percentage');
				});
			}
        });
		
    }
}
