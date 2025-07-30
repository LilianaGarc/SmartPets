<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Historia;
use App\Models\StoryMedia;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EliminarHistoriasExpiradas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'historias:limpiar';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina historias y sus archivos multimedia que han expirado (más de 24 horas).';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $historiasExpiradas = Historia::where('expires_at', '<', $now)->get();

        if ($historiasExpiradas->isEmpty()) {
            $this->info('No hay historias expiradas para eliminar.');
            return Command::SUCCESS;
        }

        $this->info('Eliminando ' . $historiasExpiradas->count() . ' historias expiradas...');

        foreach ($historiasExpiradas as $historia) {
            foreach ($historia->media as $media) {
                if (Storage::disk('public')->exists($media->file_path)) {
                    Storage::disk('public')->delete($media->file_path);
                    $this->info('Archivo eliminado: ' . $media->file_path);
                }
                $media->delete();
            }
            $historia->delete();
        }

        $this->info('Historias expiradas eliminadas con éxito.');
        return Command::SUCCESS;
    }
}
