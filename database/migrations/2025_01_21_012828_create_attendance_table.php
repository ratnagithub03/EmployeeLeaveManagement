<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for users table
            $table->timestamp('check_in')->nullable(); // Check-in timestamp
            $table->timestamp('check_out')->nullable(); // Check-out timestamp
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
?>