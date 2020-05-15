<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('weapp_openid')->default('')->nullable()->comment('微信开放id');
            $table->string('weapp_session_key')->default('')->nullable()->comment('微信session_key');
            $table->string('nickname')->default('')->nullable()->comment('昵称');
            $table->string('weapp_avatar')->default('')->nullable()->comment('微信头像');
            $table->string('country')->default('')->nullable()->comment('国家');
            $table->string('province')->default('')->nullable()->comment('省份');
            $table->string('city')->default('')->nullable()->comment('所在城市');
            $table->string('language')->default('')->nullable()->comment('语言');
            $table->string('location')->default('')->nullable()->comment('当前地理信息');
            $table->enum('gender', ['1', '2'])->default('1')->comment('性别默认男');
            $table->string('phone')->nullable()->default('')->comment('手机号码');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
