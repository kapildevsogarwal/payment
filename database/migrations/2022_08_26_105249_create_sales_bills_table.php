<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateSalesBillsTable extends Migration
{
	use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_bill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no')->nullable();
			$table->date('invoice_date')->nullable();
			$table->integer('party_id');
            $table->float('net_amount', 8, 2);
			$table->float('igst_percent', 8, 2);
			$table->float('igst_total', 8, 2);
			$table->float('ca_gst_percent', 8, 2);
			$table->float('ca_gst_total', 8, 2);
			$table->float('sgst_percent', 8, 2);
			$table->float('sgst_total', 8, 2);
			$table->float('total_amount', 8, 2);
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
        Schema::dropIfExists('party_info');
    }
}
