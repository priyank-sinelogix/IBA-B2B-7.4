<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('designation')->nullable();

            $table->enum('role', ['customer', 'admin', 'super_admin'])
                ->default('customer');

            $table->boolean('is_active')->default(true);

            $table->timestamp('last_login_at')->nullable();

            $table->index(['company_id', 'role']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['company_id', 'role']);

            $table->dropForeign(['company_id']);
            $table->dropColumn([
                'company_id',
                'designation',
                'role',
                'is_active',
                'last_login_at',
            ]);
        });
    }
};
