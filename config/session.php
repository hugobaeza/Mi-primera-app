<?php

use Illuminate\Support\Str;

return [

    'driver' => env('SESSION_DRIVER', 'cookie'), // Usamos cookie como driver
    'lifetime' => 120, // El tiempo de vida de la sesión en minutos
    'expire_on_close' => false, // Si quieres que la sesión expire al cerrar el navegador
    'encrypt' => true, // Si deseas cifrar la cookie de sesión

    'files' => storage_path('framework/sessions'), // Este campo no se utiliza cuando 'driver' es 'cookie'

    'connection' => env('SESSION_CONNECTION'), // No se usa cuando 'driver' es 'cookie'

    'table' => 'sessions', // No se usa cuando 'driver' es 'cookie'

    'store' => env('SESSION_STORE'), // No se usa cuando 'driver' es 'cookie'

    'lottery' => [2, 100], // Probabilidad de que se eliminen sesiones expiradas

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ), // Nombre de la cookie, puede ser personalizado en .env

    'path' => '/', // Ruta para la cookie
    'domain' => env('SESSION_DOMAIN', null), // Verifica que no sea null y esté configurado correctamente en .env

    'secure' => env('SESSION_SECURE_COOKIE', false), // Si la cookie debe enviarse solo por HTTPS
    'http_only' => true, // Si la cookie es solo accesible por HTTP
    'same_site' => 'lax', // Restricciones de cookies SameSite, 'lax' es adecuado para la mayoría de los casos

    'partitioned' => false, // Este campo es opcional y se refiere a particiones para la cookie

];
