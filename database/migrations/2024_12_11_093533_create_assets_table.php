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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('address');
            $table->string('manager_name')->nullable();
            $table->unsignedInteger('phone')->nullable();
            $table->timestamps();
        });

        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_number')->unique();
            $table->string('brand_name')->nullable();
            $table->string('model_number')->nullable();
            $table->string('date_manufacture')->nullable();
            $table->string('asset_type');
            $table->string('base_asset')->default('IT - Hardware');
            $table->foreignId('employee_id')->nullable()->constrained('employees');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors');
            $table->string('discription')->nullable();
            $table->timestamps();
        });

        Schema::create('barcodes', function (Blueprint $table) {
            $table->id();
            $table->string('barcode_number')->unique();
            $table->string('status')->nullable();
            $table->foreignId('asset_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
