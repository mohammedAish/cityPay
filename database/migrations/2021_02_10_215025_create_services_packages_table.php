<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('services_packages',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')
                ->on('services')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')
                ->on('packages_categories')->onDelete('cascade')->onUpdate('cascade');
            //السعر هنا هو مقدار ما سيتم أخذه من العميل مقابل توفير الخدمة
            //مثلا سنقوم بسحب ارباحه   كم سنأخذ نسبة من ارباحه لنا عند الاخذ
            //والافضل ان تكون مخفية الان حتى ننر كيف ستتم
            $table->decimal('price',11,2)->default(0);
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')
                ->on('currencies');
            //->onDelete('cascade')->onUpdate('cascade')
            $table->decimal('discount',11,2)->nullable()->default(0);
            //نقاط الولاء التي سيحصل عليها العميل جراء الاشتراك في هذة الخدمة
            //deprecated  //@todo we will enaph with operation_scores
            $table->decimal('subscription_scores',15,2)->default(0)
                ->comment('count scores which customer win when subscribe in service');
            //نقاط الولاء التي سيحصل عليها العميل جراء تنفيذ عملية من هذة الخدمة
            $table->decimal('operation_scores',15,2)->default(0)
                ->comment('count the scores will gave to customer when use this service');
            $table->unsignedInteger('orders_count')->default(0)
                ->comment('count the orders that customer can reuse this services by this price for this services,if 0 then unlimited');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('services_packages');
    }
}
