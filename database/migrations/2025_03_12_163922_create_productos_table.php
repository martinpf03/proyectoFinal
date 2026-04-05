<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('url_imagen');
            $table->text('descripcion');
            $table->integer('stock');
            $table->decimal('precio', 8, 2);
            $table->float('IVA');
            $table->enum('tipo',['consola','pieza','arcade']);
            $table->foreignId('vendedor_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};

