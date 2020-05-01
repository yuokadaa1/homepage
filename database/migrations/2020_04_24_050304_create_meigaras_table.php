<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeigarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meigaras', function (Blueprint $table) {
          $table->increments('id');
          $table->smallInteger('meigaraCode');
          $table->char('meigaraCodeA',1)->default('');
          $table->date('date');
          $table->time('time')->default('00:00');
          $table->mediumInteger('price')->nullable();
          $table->mediumInteger('openingPrice')->nullable();
          $table->mediumInteger('closingPrice')->nullable();
          $table->mediumInteger('highPrice')->nullable();
          $table->mediumInteger('lowPrice')->nullable();
          $table->integer('volume')->nullable();
          $table->integer('tradingValue')->nullable();
          $table->timestamps();

          // ユニークキー設定
          $table->unique(['meigaraCode', 'meigaraCodeA' ,'date','time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meigaras');
    }
}
