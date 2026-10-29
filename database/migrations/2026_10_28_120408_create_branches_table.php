
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('city');
            $table->string('state')->nullable();
            $table->string('pincode', 15)->nullable();
            $table->text('address');

            $table->string('phone', 20);
            $table->string('alternate_phone', 20)->nullable();
            $table->string('email')->nullable();

            $table->text('google_maps_url')->nullable();

            $table->string('opening_time', 5)->nullable();
            $table->string('closing_time', 5)->nullable();
            $table->string('working_days')->nullable();

            $table->string('image')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_primary')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
