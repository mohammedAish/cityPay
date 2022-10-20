<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('consultants',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('consultants_category_id');
            $table->foreign('consultants_category_id')->references('id')
                ->on('consultants_categories');
            $table->string('name',3000);
            $table->enum('consultant_type',['free','paid']);
            //هذا الحقل لا يستطيع الادمن  تغييره حيث ان قيمته ستحدد من جدول ال  services ومن الكونفج المخصص
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')
                ->on('services');
            //and when build relation then must be same the services id for this model
            //so the service_id for constraints only
            //بمعنى انه رقم السيرفس هنا كحامي في أنه عند اختيار سيرفس البكج
            // فيجب أن تكون السيرفس بكج ايد للسيرفس المختارة هي نفس السيرفس بكج التي تم اختيارها مسبقا لهذا المودل
            $table->unsignedBigInteger('service_package_id')->nullable();
            $table->foreign('service_package_id')->references('id')
                ->on('services_packages');
            $table->text('description')->nullable();
            $table->text('img_path')->nullable();
            $table->text('external_link')->nullable();
            //  $table->unique('name','service_package_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('consultants');
    }
}
