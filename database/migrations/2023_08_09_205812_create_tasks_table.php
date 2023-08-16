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
        Schema::create('tasks', function (Blueprint $table)
            {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->date('date_due')->nullable();
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Low');
            $table->enum('status', ['Not Started', 'In Progress', 'Completed'])->default('Not Started');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down() : void
        {
        Schema::dropIfExists('tasks');
        }
    };
