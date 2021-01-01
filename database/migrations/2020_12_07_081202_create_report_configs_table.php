<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained();
            $table->boolean('code')->nullable();
            $table->boolean('cnpj')->nullable();
            $table->boolean('company_type')->nullable();
            $table->boolean('corporate_name')->nullable();
            $table->boolean('city')->nullable();
            $table->boolean('passwords')->nullable();
            $table->boolean('contact_mails')->nullable();
            $table->boolean('comments')->nullable();
            $table->boolean('f1')->nullable(); // data de vencimento
            $table->boolean('f2')->nullable(); // valor
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_configs');
    }
}
