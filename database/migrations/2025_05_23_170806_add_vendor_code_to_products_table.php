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
        Schema::table('products', function (Blueprint $table) {
            // vendor_codeカラムを設定する
            $table->integer('vendor_code')->nullable();
            // vendor_codeカラムに外部キー制約を付与
            $table->foreign('vendor_code')->references('vendor_code')->on('vendors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //　ロールバック時にvendor_codeカラムの外部キー制約を削除
            $table->dropForeign(['vendor_code']);
            // ロールバック時にvendor_codeカラムを削除
            $table->dropColumn('vebdor_code');
        });
    }
};
