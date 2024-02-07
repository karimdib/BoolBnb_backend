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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('rooms')->nullable();
            $table->unsignedInteger('beds')->nullable();
            $table->unsignedInteger('bathrooms')->nullable();
            $table->unsignedInteger('square_meters')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->boolean('visible')->nullable();
            $table->string('cover_image')->nullable();
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
        $cover_images_path = 'storage\app\public\cover_images';       
        // Ottieni l'elenco di tutti i file nella cartella
        $files = File::allFiles($cover_images_path);
        // Elimina ciascun file all'interno della cartella
        File::delete($files);

        Schema::dropIfExists('apartments');

        }
};
