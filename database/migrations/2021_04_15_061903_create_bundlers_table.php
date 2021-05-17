<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundlers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('endpoint_1');
            $table->string('method_1');
            $table->longText('headers_1')->nullable();
            $table->longText('data_1')->nullable();
            $table->string('response_type_1');
            $table->string('response_content_1')->default('JSON');
            $table->string('endpoint_2');
            $table->string('method_2');
            $table->longText('headers_2')->nullable();
            $table->longText('data_2')->nullable();
            $table->string('response_type_2');
            $table->string('response_content_2')->default('JSON');
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
        Schema::dropIfExists('bundlers');
    }
}
