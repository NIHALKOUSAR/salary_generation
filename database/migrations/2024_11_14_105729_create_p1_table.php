<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('p1', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('cid');
        $table->unsignedBigInteger('did');
        $table->string('employee_name');
        $table->string('role');
        $table->string('account_number');
        $table->string('bank_name');
        $table->string('ifsc');
        $table->string('payment_mode');
        $table->string('payment_account');
        $table->boolean('variable_da')->default(false);
        $table->decimal('basic', 10, 2);
        $table->decimal('agp', 10, 2);
        $table->decimal('fixed_da', 10, 2);
        $table->decimal('hra', 10, 2);
        $table->decimal('special_pay', 10, 2);
        $table->decimal('hp_allowance', 10, 2);
        $table->boolean('pf_applicable')->default(false);
        $table->boolean('security_deduction')->default(false);
        $table->date('joining_date');
        $table->decimal('gross', 10, 2);
        $table->decimal('grand_total', 10, 2);
        $table->decimal('pf_employee_contrbn_12', 10, 2)->nullable();
        $table->decimal('pf_employer_contrbn_13', 10, 2)->nullable();
        $table->decimal('pt', 10, 2)->nullable();
        $table->timestamps();

        $table->foreign('institute_id')->references('id')->on('clg');
        $table->foreign('department_id')->references('id')->on('dept');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p1');
    }
};
