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
        Schema::table('tbl_users', function (Blueprint $table) {
            $table->foreignId('floor_id')
                ->nullable()
                ->constrained('production_floors')
                ->onDelete('set null');

            $table->foreignId('table_id')
                ->nullable()
                ->constrained('production_tables')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            $table->dropForeign(['floor_id']);
            $table->dropForeign(['table_id']);
            $table->dropColumn(['floor_id', 'table_id']);
        });
    }
};
