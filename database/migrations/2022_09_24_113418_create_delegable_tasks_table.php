<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegableTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegable_tasks', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('delegable_id');
            $table->string('task_id');
            $table->timestamps();

            $table->foreign('delegable_id')
                ->references('id')
                ->on('delegables');

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delegable_tasks');
    }
}
