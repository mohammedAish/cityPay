<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersServicesPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customers_services_packages',function (Blueprint $table){
//            $table->id();
//            $table->unsignedBigInteger('customer_id');
//            $table->foreign('customer_id')->references('id')
//                ->on('customers');
//            $table->unsignedBigInteger('service_package_id');
//            $table->foreign('service_package_id')->references('id')
//                ->on('services_packages');
//             //عند الاشتراك في الخدمة قد يكون هناك شخص هو من أحال العميل للاشتراك فيها
//          /*  $table->unsignedBigInteger('participate_customer_id')->nullable()
//            ->comment('who did recommendation for this customer to participate');*/
//            $table->timestamp('start_subscription')->nullable();
//            $table->timestamp('end_subscription')->nullable();
//            $table->text('description')->nullable();
//            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customers_services_packages');
    }
}
