
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone', 20);
            $table->string('email')->nullable();

            $table->enum('type', [
                'general',
                'service',
                'academy',
                'bridal',
                'other',
            ])->default('general');

            $table->string('subject')->nullable();
            $table->text('message')->nullable();

            $table->enum('status', [
                'new',
                'contacted',
                'follow_up',
                'converted',
                'closed',
            ])->default('new');

            $table->string('source')->default('admin');
            $table->text('admin_notes')->nullable();
            $table->dateTime('follow_up_at')->nullable();

            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('follow_up_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
