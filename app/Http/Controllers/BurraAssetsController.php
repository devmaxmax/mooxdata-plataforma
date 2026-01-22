<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BurraAssetsController extends Controller
{
    public function serve($type, $filename)
    {
        // Alias para carpetas (img -> images)
        $folder = ($type === 'img') ? 'images' : $type;
        $path = "burra_assets/{$folder}/{$filename}";

        if (!Storage::exists($path)) {
            abort(404);
        }
        $mimeTypes = [
            'css' => 'text/css',
            'js'  => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg'=> 'image/jpeg',
            'svg' => 'image/svg+xml',
            'gif' => 'image/gif',
            'webp'=> 'image/webp',
        ];

        // Determinar mime type basado en extensión si el type no coincide directamente (para carpeta 'images')
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $contentType = $mimeTypes[$extension] ?? $mimeTypes[$type] ?? 'application/octet-stream';

        $fileContent = Storage::get($path);

        return response($fileContent, 200, [
            'Content-Type' => $contentType,
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
        ]);
        
        // OPCIÓN ALTERNATIVA (Más eficiente si usas response()->file):
        // return response()->file(storage_path("app/{$path}"), [
        //    'Content-Type' => $mimeTypes[$type]
        // ]);
    }
}
