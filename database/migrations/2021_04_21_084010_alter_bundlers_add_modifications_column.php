<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBundlersAddModificationsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('bundlers', 'modifications')) {
            Schema::table('bundlers', function (Blueprint $table) {
                $table->longText('modifications')->after('response_content_2')->nullable();
            });
        }

        if(!Schema::hasColumn('bundlers', 'iterative_index')) {
            Schema::table('bundlers', function (Blueprint $table) {
                $table->string('iterative_index')->after('endpoint_1')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('bundlers', 'modifications')) {
            Schema::table('bundlers', function ($table) {
                $table->dropColumn('modifications');
            });
        }

        if (Schema::hasColumn('bundlers', 'iterative_index')) {
            Schema::table('bundlers', function ($table) {
                $table->dropColumn('iterative_index');
            });
        }
    }
}
