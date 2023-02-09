<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('app_master_cabang', function (Blueprint $table) {
            $table->string('kodecabang',8)->primary();
            $table->string('namacabang',50)->nullable();
            $table->string('kodeinduk',50)->nullable();
            $table->string('kodekanwil',50)->nullable();
            $table->string('status',1)->nullable();
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        // Schema::dropIfExists('master_page');
    }

}
