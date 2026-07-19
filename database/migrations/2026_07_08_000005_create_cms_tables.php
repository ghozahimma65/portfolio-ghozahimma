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
        // 1. Skills Table
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // Backend, Frontend, Mobile, Database, API, IoT, Tools
            $table->string('icon')->nullable();
            $table->string('level')->default('Intermediate'); // Beginner, Intermediate, Advanced, Expert
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 2. Settings (Key-Value Key store) Table
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // 3. Educations Table
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('school');
            $table->string('degree')->nullable();
            $table->string('major')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 4. Organizations Table
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('organization');
            $table->string('position');
            $table->string('start_date');
            $table->string('end_date');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 5. Awards Table
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issuer')->nullable();
            $table->string('year');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 6. Social Links Table
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // Platform Name (e.g. GitHub)
            $table->string('icon')->nullable();     // Icon Class (e.g. bi bi-github)
            $table->string('url');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 7. Blog Categories Table
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 8. Blog Posts Table
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('blog_categories')->nullOnDelete();
            $table->string('status')->default('draft'); // draft, published
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // 9. Blog Tags Table
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 10. Blog Post-Tag Pivot Table
        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('blog_posts')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('blog_tags')->onDelete('cascade');
            $table->primary(['post_id', 'tag_id']);
        });

        // 11. Media Library Table
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('filepath');
            $table->string('file_type')->nullable();
            $table->unsignedInteger('file_size')->default(0);
            $table->timestamps();
        });

        // 12. Analytics Logs Table
        Schema::create('analytics_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // visitor_hit, cv_download, project_view
            $table->string('event_payload')->nullable(); // Page name, CV filename, Project ID
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_logs');
        Schema::dropIfExists('media');
        Schema::dropIfExists('blog_post_tag');
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('social_links');
        Schema::dropIfExists('awards');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('educations');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('skills');
    }
};
