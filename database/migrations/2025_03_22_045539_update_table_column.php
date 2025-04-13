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
        Schema::table('locations', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name'); // Add a unique slug column
        });
        Schema::table('fields', function (Blueprint $table) {
            $table->integer('number');
            $table->foreignId('field_type_id')->constrained('field_types')->onDelete('cascade')->after('name');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade')->after('name');
        });
        Schema::table('field_types', function (Blueprint $table) {
            $table->integer('location_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('fields', function (Blueprint $table) {
            $table->dropForeign(['field_type_id', 'location_id']);
            $table->dropColumn(['number', 'field_type_id', 'location_id']);
        });
        Schema::table('field_types', function (Blueprint $table) {
            $table->dropColumn('location_id');
        });
    }
};
