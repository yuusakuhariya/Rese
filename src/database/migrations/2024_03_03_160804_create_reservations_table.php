<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->integer('number_of_person');
            $table->string('payment_status')->nullable(); // 支払いの状態を示すフラグなど
            $table->string('payment_reference')->nullable(); // Stripe の支払い ID やトランザクション ID
            $table->boolean('is_visited')->default(false); //来店カラム、デフォルトではfalseにする
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
