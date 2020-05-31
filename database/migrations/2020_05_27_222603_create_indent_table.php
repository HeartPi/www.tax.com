<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndentTable extends Migration
{
    
    protected $table = 'indent';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if(Schema::hasTable($this->table)) {
            return true;
        }
        Schema::create('indent', function (Blueprint $table) {
            //数据id
            $table->id();
            $table->string('recognizee')->comment('被保人');
            $table->string('identity_card')->uniqid()->nullable()->comment('身份号码');
            $table->string('license_plate_number')->nullable()->comment('车牌号');
            $table->string('vin')->uniqid()->nullable()->comment('车架号');
            $table->string('engine_number')->uniqid()->nullable()->comment('发动机号');
            $table->date('record_date')->uniqid()->comment('登记日期');
            $table->string('nature')->nullable()->comment('使用性质');
            $table->string('weight')->nullable()->comment('总质量');
            $table->string('check_weight')->nullable()->comment('核定质量');
            $table->string('equipment_quality')->nullable()->comment('装备质量');
            $table->string('tax')->nullable()->comment('税额');
            $table->timestamps();
        });
        
        \DB::statement("ALTER TABLE `$this->table` comment '订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indent');
    }
}
