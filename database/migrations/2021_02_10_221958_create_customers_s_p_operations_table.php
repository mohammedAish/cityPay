<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//هذا يعتبر كأنه تفاصيل لعمليات الاشتراك في الخدمات المسجل في جدول customers_services_packages
//بحيث ان هناك خدمات سيشترك فيها العميل وتسجل بيانات الاشتراك في ذلك الجدول وأيضا تسجل بيانات تفاصيلها هنا مثل سحب الارباح من النت - الشراء عبر النت
// وهناك خدمات سيكتفى بتسجيل بيانات الاشتراك فيها في جدول customers_services_packages بينما تفاصيل البيانات
// ستسجل في جداولها التابعة وذلك مثل خدمة شراء البطاقات الرقمية سيتم تخزين اشتراك الشراء في الجدول   customers_services_packages
// بينما بيانات الشراء سيتم تخزينها في جداول الكروت المشتراه
//أيضا خدمة التدريب والتحليل سيتم ذكر عملية الاشتراك في الجدول الأب بينما التفاصيل في جداول التدريب


//خلاص نتخلى عن الاب لان ما منه فايدة
//  وهذا الجدول هو الجدول التي تخزن فيه كل انواع الطلبات وتفاصيلها ستخزن في جداولها مثل الكروت الرقمية والاستشارات وسحب الارباح
class CreateCustomersSPOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customer_s_p_ops',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')
                ->on('customers');
            $table->unsignedBigInteger('service_package_id');
            $table->foreign('service_package_id')->references('id')
                ->on('services_packages');
            $table->text('description')->nullable()
                ->comment('this will fill by customer');
            $table->text('link_url')->nullable();
            $table->text('file_path')->nullable();
            $table->enum('current_status',array_keys(config('ytadawul.order_status')));
            $table->text('ip_address')->nullable();
            $table->enum('device_type',['web','mobile'])->default('web');
            $table->text('device_info');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('customers_s_p_operations');
    }
}
