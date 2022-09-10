<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('invoice_no',32)->comment("Numer Faktury");
            $table->string('seller_nip',10)->comment("Numer Nip Sprzedawcy");
            $table->string('buyer_nip',10)->comment("Numer Nip Kupującego");
            $table->string('product',254)->commnet("Nazwa produktu");
            $table->integer('amount')->unsigned()->comment("Kwota netto zapisana  jako integer");

            $table->index('invoice_no');
            $table->index('seller_nip');
            $table->index('buyer_nip');
            
            $table->charset = 'utf8';
            $table->collation = 'utf8_polish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
