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

        Schema::table('users', function (Blueprint $table) {
            $table->string('job')->nullable()->change();
            $table->string('industry')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->text('reasons_attending')->nullable()->change();
            $table->text('interest')->nullable()->change();
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
