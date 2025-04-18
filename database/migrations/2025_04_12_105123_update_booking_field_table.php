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
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('field_id');
            $table->string('location_name')->after('booking_code'); 
        });
        Schema::table('booking_times', function (Blueprint $table) {
            $table->foreignId('booking_field_id')->constrained()->onDelete('cascade');
            $table->foreignId('schedule_pivot_id')->constrained()->onDelete('cascade')->after('booking_field_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('bookings', function (Blueprint $table) {
            // $table->integer('field_id');
            // $table->dropColumn('location_name'); 
        // });
        // Schema::table('booking_times',function (Blueprint $table) {
        //         $table->dropColumn('booking_field_id');
        //         $table->dropColumn('schedule_pivot_id');
        //     }
        // );
    }
};
