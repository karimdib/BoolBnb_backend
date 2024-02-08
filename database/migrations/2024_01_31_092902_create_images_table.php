<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //QUESTA FUNZIONE FUNZIONA SOLO CON IL ROLLBACK, CON IL MIGRATE:FRESH NO
        // Otteniamo il percorso della cartella
        $images_path = 'storage\app\public\images';       
        // Ottieni l'elenco di tutti i file nella cartella
        $files = File::allFiles($images_path);
        // Elimina ciascun file all'interno della cartella
        File::delete($files);

        Schema::dropIfExists('images');
    }
};
