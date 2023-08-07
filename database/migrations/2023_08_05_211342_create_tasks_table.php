<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('user_created_id')->constrained('users');
            $table->foreignId('user_assigned_id')->constrained('users')->nullable();
            $table->enum('status', ['todo', 'in_progress', 'done'])->default('todo');
            $table->timestamp('deadline')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Додаємо "софт" видалення
        });
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('tasks');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};

