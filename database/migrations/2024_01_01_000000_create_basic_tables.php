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
        // Create users table for Laravel compatibility
        // This mirrors the Supabase auth.users table structure
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name')->nullable();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('phone')->nullable();
                $table->string('password')->nullable();
                $table->json('raw_user_meta_data')->nullable();
                $table->json('raw_app_meta_data')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // Create bills table
        if (!Schema::hasTable('bills')) {
            Schema::create('bills', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('title');
                $table->text('description')->nullable();
                $table->decimal('total_amount', 15, 2);
                $table->string('currency', 3)->default('IDR');
                $table->timestamp('bill_date');
                $table->uuid('created_by');
                $table->string('category');
                $table->decimal('tax_amount', 15, 2)->default(0);
                $table->decimal('tip_amount', 15, 2)->default(0);
                $table->decimal('discount_amount', 15, 2)->default(0);
                $table->string('receipt_image_url')->nullable();
                $table->enum('status', ['draft', 'active', 'settled', 'cancelled'])->default('draft');
                $table->enum('split_method', ['equal', 'custom', 'percentage', 'item'])->default('equal');
                $table->json('metadata')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
                $table->index(['created_by', 'status']);
                $table->index('bill_date');
            });
        }

        // Create bill_items table
        if (!Schema::hasTable('bill_items')) {
            Schema::create('bill_items', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('bill_id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->decimal('quantity', 10, 2)->default(1);
                $table->decimal('unit_price', 15, 2);
                $table->decimal('total_price', 15, 2);
                $table->string('category')->nullable();
                $table->json('metadata')->nullable();
                $table->timestamps();

                $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
                $table->index('bill_id');
            });
        }

        // Create bill_participants table
        if (!Schema::hasTable('bill_participants')) {
            Schema::create('bill_participants', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('bill_id');
                $table->uuid('user_id');
                $table->decimal('share_amount', 15, 2)->nullable();
                $table->decimal('share_percentage', 5, 2)->nullable();
                $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
                $table->timestamp('joined_at')->nullable();
                $table->timestamps();

                $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unique(['bill_id', 'user_id']);
                $table->index(['user_id', 'status']);
            });
        }

        // Create settlements table
        if (!Schema::hasTable('settlements')) {
            Schema::create('settlements', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('bill_id');
                $table->uuid('from_user_id');
                $table->uuid('to_user_id');
                $table->decimal('amount', 15, 2);
                $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
                $table->string('payment_method')->nullable();
                $table->string('payment_reference')->nullable();
                $table->timestamp('settled_at')->nullable();
                $table->json('metadata')->nullable();
                $table->timestamps();

                $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
                $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('to_user_id')->references('id')->on('users')->onDelete('cascade');
                $table->index(['from_user_id', 'status']);
                $table->index(['to_user_id', 'status']);
            });
        }

        // Create item_assignments table
        if (!Schema::hasTable('item_assignments')) {
            Schema::create('item_assignments', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('item_id');
                $table->uuid('user_id');
                $table->decimal('quantity', 10, 2)->default(1);
                $table->decimal('assigned_amount', 15, 2);
                $table->timestamps();

                $table->foreign('item_id')->references('id')->on('bill_items')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unique(['item_id', 'user_id']);
            });
        }

        // Create friendships table
        if (!Schema::hasTable('friendships')) {
            Schema::create('friendships', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('user_id');
                $table->uuid('friend_id');
                $table->enum('status', ['pending', 'accepted', 'declined', 'blocked'])->default('pending');
                $table->timestamp('requested_at')->useCurrent();
                $table->timestamp('accepted_at')->nullable();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
                $table->unique(['user_id', 'friend_id']);
                $table->index(['user_id', 'status']);
                $table->index(['friend_id', 'status']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendships');
        Schema::dropIfExists('item_assignments');
        Schema::dropIfExists('settlements');
        Schema::dropIfExists('bill_participants');
        Schema::dropIfExists('bill_items');
        Schema::dropIfExists('bills');
        Schema::dropIfExists('users');
    }
};
