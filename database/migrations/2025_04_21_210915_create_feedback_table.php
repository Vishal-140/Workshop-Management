<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('workshop_id')->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->text('feedback_text');
            $table->timestamp('submitted_at');
            $table->timestamps();
            
            // Ensure a user can only give one feedback per workshop
            $table->unique(['user_id', 'workshop_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
