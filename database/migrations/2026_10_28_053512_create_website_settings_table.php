
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name')->default('Kutzz The Salon');
            $table->string('site_tagline')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->string('primary_color', 7)->default('#D60927');
            $table->string('secondary_color', 7)->default('#A60820');
            $table->string('light_color', 7)->default('#FFF2F4');

            $table->string('heading_font')->default('Poppins');
            $table->string('body_font')->default('Inter');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
