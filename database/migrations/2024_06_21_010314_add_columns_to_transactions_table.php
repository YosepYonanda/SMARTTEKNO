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
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'product_id')) {
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('transactions', 'quantity')) {
                $table->integer('quantity');
            }
            if (!Schema::hasColumn('transactions', 'transaction_total')) {
                $table->decimal('transaction_total', 15, 2);
            }
            if (!Schema::hasColumn('transactions', 'status')) {
                $table->string('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
            if (Schema::hasColumn('transactions', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('transactions', 'transaction_total')) {
                $table->dropColumn('transaction_total');
            }
            if (Schema::hasColumn('transactions', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
