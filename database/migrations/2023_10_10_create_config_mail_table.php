<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_mail', function (Blueprint $table) {
            $table->id();
            $table->string('smtp_host')->nullable(); // SMTP server host
            $table->string('smtp_port')->nullable(); // SMTP port
            $table->string('smtp_username')->nullable(); // SMTP username
            $table->string('smtp_password')->nullable(); // SMTP password
            $table->string('smtp_encryption')->nullable(); // TLS/SSL
            $table->timestamps();
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_mail');
    }
};