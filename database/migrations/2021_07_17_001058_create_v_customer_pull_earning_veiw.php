<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVCustomerPullEarningVeiw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       \DB::statement("create or replace view v_customer_pull_earnings as 
        
          select * from pull_earnings
         ");
        /* cu._id as customer_id,p_e.id as pull_earning_id,
           'product_name', 'paying_date', 'product_price', 'real_price', 'currency_id', 'commission_percent',
           'commission_fee', 'final_price', 'description', 'link_url', 'file_path', 'current_status', 'withdraw_id',
            'admin_id', 'admin_note'*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_customer_pull_earning_veiw');
    }
}
