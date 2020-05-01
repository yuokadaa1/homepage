<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGPIFSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpifs', function (Blueprint $table) {
          $table->increments('id');
          $table->date('date');
          $table->Integer('ETF')->nullable();
          $table->Integer('support')->nullable();
          $table->Integer('J-REIT')->nullable();
          $table->timestamps();

          // ユニークキー設定
          $table->unique(['date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gpifs');
    }
}
