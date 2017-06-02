<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageviewsIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pageviews', function (Blueprint $table) {
            # $table->index(['user_id', 'domain']); // We dropped this one, [domain, user_id] was less efficient
            $table->index(['user_id', 'customer_id']);
            $table->index(['domain', 'user_id']);
            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pageviews', function (Blueprint $table) {
            //
        });
    }
}
