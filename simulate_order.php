<?php

use App\Models\Burra\BurraProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\BurraController;

// 1. Crear un Request Mockeado para procesarPedido
$payload = [
    'pedido' => [
        'productos' => [
            [
                'id' => 123, 
                'nombre' => 'Producto Test Fudo', 
                'cantidad' => 1, 
                'precio' => 1000,
            ]
        ],
        'preguntas' => [
            ['pregunta' => 'Nombre y Apellido(*)', 'respuesta' => 'Test User Fudo'],
            ['pregunta' => 'Dirección(*)', 'respuesta' => 'Calle Falsa 123'],
            ['pregunta' => 'Forma de pago(*):', 'respuesta' => 'Efectivo'],
        ],
        'whatsapp' => '5491100000000',
        'precio_final' => 1000
    ]
];

// Asegurarnos de que el producto con ID mockeado exista o usar uno real
$product = BurraProduct::first();
if ($product) {
    if (!$product->code_fuda) {
        $product->code_fuda = '100'; // Set dummy code if missing so it tries to sync
        $product->save();
    }
    
    $payload['pedido']['productos'][0]['id'] = $product->id;
    $payload['pedido']['productos'][0]['nombre'] = $product->name;
    // Keep price and qty
} else {
    echo "No hay productos en DB para testear.\n";
    exit;
}

$request = Request::create('/burra/procesar-pedido', 'POST', $payload);

// 2. Instanciar controlador (Mockear dependencias si hiciera falta, pero aquí queremos integración real)
$controller = app()->make(BurraController::class);

echo "Simulando pedido...\n";

// 3. Ejecutar
try {
    $response = $controller->procesarPedido($request);
    echo "Respuesta Controller: " . $response->getContent() . "\n";
} catch (\Exception $e) {
    echo "Excepción: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

// 4. Ver logs recientes
echo "\n--- Logs Recientes (fuda_debug.log) ---\n";
if (file_exists(storage_path('logs/fuda_debug.log'))) {
    echo mb_substr(file_get_contents(storage_path('logs/fuda_debug.log')), -2000);
}
