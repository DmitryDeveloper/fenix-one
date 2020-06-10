<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class UpdatePostsTable
 */
class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table("posts", static function (Blueprint $table) {
            $table->boolean("email_checkbox")
                ->after('text')
                ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table("posts", static function (Blueprint $table) {
            $table->dropColumn("email_checkbox");
        });
    }
}
