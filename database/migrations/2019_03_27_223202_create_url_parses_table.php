<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlParsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_parses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('task_parses_id');
            $table->text('url')->nullable();
            $table->longText('json_result')->nullable();
            $table->integer('is_parsed')->nullable();
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
        Schema::dropIfExists('url_parses');
    }
}
