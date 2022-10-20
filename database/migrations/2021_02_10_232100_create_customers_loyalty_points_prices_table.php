<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersLoyaltyPointsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customers_loyalty_points_prices',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            $table->unsignedBigInteger('customer_s_p_ops_id')->nullable();
            $table->foreign('customer_s_p_ops_id','cust_s_p_ops_loyalty_points_fk')
                ->references('id')
                ->on('customer_s_p_ops');
            $table->decimal('count_scores',15,2)->default(0);
            //هل مستحقة أم مؤكدة المستحقة يجب أن تؤكد حين معالجة الطلب
            $table->enum('score_type',['confirmed','deserved'])->default('deserved');
            $table->boolean('transferred')->default(0)
                ->comment('when transferred wil convert to equable price');
            $table->timestamp('transferred_date')->nullable();
            $table->enum('transferred_by',['admin','customer'])->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customers_loyalty_points_prices');
    }
}
