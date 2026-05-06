<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('is_completed');
        });

        // 既存レコードに created_at DESC の順で初期値を設定（表示順を維持）
        $ids = DB::table('todos')->orderByDesc('created_at')->pluck('id');
        foreach ($ids as $i => $id) {
            DB::table('todos')->where('id', $id)->update(['order' => $i]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
