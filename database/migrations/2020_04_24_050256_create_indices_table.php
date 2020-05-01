<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('indices', function (Blueprint $table) {
        $table->increments('id');
        $table->char('index',10);
        $table->date('date');
        $table->time('time')->nullable();
        $table->float('price',8,2)->nullable();
        $table->float('openingPrice',8,2)->nullable();
        $table->float('closingPrice',8,2)->nullable();
        $table->float('highPrice',8,2)->nullable();
        $table->float('lowPrice',8,2)->nullable();
        $table->float('beforeRatio',8,2)->nullable();
        $table->float('beforeRatioP',6,3)->nullable();
        $table->integer('volume')->nullable();
        $table->integer('tradingValue')->nullable();
        $table->timestamps();

        // ユニークキー設定
        $table->unique(['index' ,'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indices');
    }
}
