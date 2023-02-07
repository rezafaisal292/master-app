<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_page', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama',30);
            $table->string('url',30);
            $table->string('icon',30)->nullable();
            $table->uuid('parent')->nullable();
            $table->integer('urutan');
            $table->char('status',1);
            $table->timestamps();
        });
        Schema::create('master_option_group', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 150);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'name']);
        });

        Schema::create('master_option_value', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('option_group_id');
            $table->string('key', 150);
            $table->string('value', 150);
            $table->integer('sequence');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'option_group_id', 'key']);

            $table->foreign('option_group_id')
                ->references('id')
                ->on('master_option_group')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_page');
        Schema::dropIfExists('master_option_group');
        Schema::dropIfExists('master_option_value');
    }
};
