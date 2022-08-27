<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomAttributesToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ip_address')->nullable()->after('email');
            $table->string('lat_lng')->nullable()->after('ip_address');
            $table->boolean('is_online')->default(true)->after('lat_lng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ip_address');
            $table->dropColumn('lat_lng');
            $table->dropColumn('is_online');

        });
    }
}
