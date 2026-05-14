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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('address_en')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('hours_en')->nullable();
            $table->string('hours_ar')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('tiktok')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'address_en',
                'address_ar',
                'hours_en',
                'hours_ar',
                'facebook',
                'twitter',
                'instagram',
                'snapchat',
                'tiktok'
            ]);
        });
    }
};
