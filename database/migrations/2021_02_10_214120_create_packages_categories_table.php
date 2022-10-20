<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('packages_categories',function (Blueprint $table){
            $table->id();
            $table->string('name',1000);
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            //لعمل بكجز اكثر يلزم تعديل العمود هذا مع الجداول المرتبطة به
            // عدد أيام البكج ويجب أن تكون فرييييدة يا اما مرة واحدة وهي المرمز لها بالصفر او اشتراك ليوم او لاسبوع او لشهر
            //الان لن يتم تفعيل سوى رقم واحد
            $table->enum('num_days',[0,1,7,31,365])->unique()
                ->comment('for once usage 0 ,for one day 1 , for week 7 for month 31 for year 365');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('prices_packages');
    }
}
