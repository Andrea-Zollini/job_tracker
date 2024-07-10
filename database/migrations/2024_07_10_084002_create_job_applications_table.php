<?php

use App\ApplicationStatus;
use App\JobType;
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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table
                ->foreignId('user_id')
                ->index()
                ->constrained('users')
                ->cascadeOnDelete();


            $table->string('job_title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('company_name');
            $table->string('location');
            $table->string('job_type')->default(JobType::NotSet->value);
            $table->string('status')->default(ApplicationStatus::Pending->value);
            $table->json('metadata')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
