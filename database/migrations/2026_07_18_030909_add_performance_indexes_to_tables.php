<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds indexes on frequently queried columns identified in the Phase 2 audit.
     */
    public function up(): void
    {
        // projects.status — filtered on every public portfolio page load
        Schema::table('projects', function (Blueprint $table) {
            $table->index('status');
        });

        // blog_posts: status (admin/public filter) and published_at (ORDER BY on public blog)
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->index('status');
            $table->index('published_at');
        });

        // contact_messages.is_read — used in dashboard unread count query
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->index('is_read');
        });

        // analytics_logs: event_type (aggregation queries) and created_at (ORDER BY / pruning)
        Schema::table('analytics_logs', function (Blueprint $table) {
            $table->index('event_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['published_at']);
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropIndex(['is_read']);
        });

        Schema::table('analytics_logs', function (Blueprint $table) {
            $table->dropIndex(['event_type']);
            $table->dropIndex(['created_at']);
        });
    }
};
