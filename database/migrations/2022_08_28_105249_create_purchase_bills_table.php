<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreatePurchaseBillsTable extends Migration
{
	use SoftDeletes;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_bill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no')->nullable();
			$table->date('invoice_date')->nullable();
			$table->integer('party_id')->nullable();;
            $table->float('net_amount', 8, 2)->nullable();;
			$table->float('igst_total', 8, 2)->nullable();;
			$table->float('ca_gst_total', 8, 2)->nullable();;
			$table->float('sgst_total', 8, 2)->nullable();;
			$table->float('total_amount', 8, 2)->nullable();;
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
