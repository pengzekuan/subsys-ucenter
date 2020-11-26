<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 商家数据表迁移脚本
 * Class CreateMerchantTable
 */
class CreateMerchantTable extends Migration
{
    /**
     * run the migration
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uc_merchant', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * reverse the migration
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uc_merchant');
    }
}