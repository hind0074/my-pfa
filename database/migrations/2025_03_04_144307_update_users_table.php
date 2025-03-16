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
            // Supprimer les colonnes inutiles
            $table->dropColumn([
                'email_verified_at', 'remember_token'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Si besoin, on peut recréer ces colonnes en cas de rollback
            $table->string('email_verified_at')->nullable();
            $table->text('remember_token')->nullable();
        });
    }
};
