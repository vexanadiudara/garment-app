<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuratPerintahKerjasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_perintah_kerjas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('line_id');
            $table->date('date');
            $table->integer('suratkeluarbarang_id');
            $table->integer('brand_id');
            $table->integer('article_id');
            $table->integer('color_id');
            $table->integer('size_id');
            $table->integer('quantity_pcs');
            $table->decimal('quantity_lsn');
            $table->integer('created_by');
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
        Schema::drop('surat_perintah_kerjas');
    }
}
