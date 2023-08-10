<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
        {
        Schema::table('users', function (Blueprint $table)
            {
            $table->string('username');
            $table->enum('user_type',['User','admin'])->default('User');
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down() : void
        {
        Schema::table('users', function (Blueprint $table)
            {
            $table->dropColumn('username')->after('id');
            $table->dropColumn('user_type')->after('password');
            });
        }
    };
