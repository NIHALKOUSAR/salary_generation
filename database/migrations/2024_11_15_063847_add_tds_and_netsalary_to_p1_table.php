<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('p1', function (Blueprint $table) {
        $table->decimal('tds', 10, 2)->nullable(); // Add tds column
        $table->decimal('netsalary', 10, 2)->nullable(); // Add netsalary column
    });
}

public function down()
{
    Schema::table('p1', function (Blueprint $table) {
        $table->dropColumn(['tds', 'netsalary']);
    });
}

};
