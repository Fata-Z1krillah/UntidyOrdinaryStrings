<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'guru', 'peserta'])->default('peserta')->after('email');
            $table->string('avatar')->nullable()->after('role');
            $table->date('tanggal_lahir')->nullable()->after('avatar');
            $table->string('google_id')->nullable()->after('tanggal_lahir');
            $table->boolean('is_active')->default(true)->after('google_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'avatar', 'tanggal_lahir', 'google_id', 'is_active']);
        });
    }
};
