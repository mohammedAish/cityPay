<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVCustomerPayingProductsVeiw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

       \DB::statement("create or replace view v_customer_paying_products_orders as 
        
          select * from paying_orders
         ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_customer_paying_products_veiw');
    }
}
