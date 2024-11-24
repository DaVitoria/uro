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
        Schema::table('users', function (Blueprint $table) {
          $table->string('two_factor_secret')->nullable();
          $table->boolean('two_factor_enabled')->default(false);
          $table->string('github_id')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('two_factor_secret');
          $table->dropColumn('two_factor_enabled');
          $table->dropColumn('github_id');
        });
    }
};