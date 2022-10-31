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
        Schema::table('base_folders_accesses', function (Blueprint $table) {
            $table->enum('status', ['accept', 'pending', 'denied']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('base_folders_accesses', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
