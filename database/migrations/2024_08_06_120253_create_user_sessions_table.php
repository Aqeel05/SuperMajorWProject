<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('user_sessions', function (Blueprint $table) {
            $table->id();
            $table->json('datetimes'); // Store array of timestamps
            $table->json('datetimes1')->nullable(); // Store array of capture timestamps
            $table->unsignedBigInteger('user_id'); // User ID
            $table->timestamps();
            
            // Foreign key constraint if you have a users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_sessions');
    }
}
