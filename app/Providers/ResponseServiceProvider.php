<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('apiSuccess', function($data = null,?string $message = null, int $status = 200) : JsonResponse{
            return response()->json([
                'status'    => 'succes',
                'message'   => $message,
                'data'      => $data
            ], $status);
        });

        Response::macro('apiError', function(?string $message = null, $error = null, int $status = 400, $data = null) {
            return response()->json([
                'status'  => false,
                'message' => $message,
                'error'   => $error,
                'data'    => $data
            ], $status);
        });


        Response::macro('apiCatchError', function(Exception $e, int $status = 500) : JsonResponse {

            Log::error("API Exception", [
                'message'   => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
                'trace'     => $e->getTraceAsString()
            ]);

            return response()->json([
                'status'    => false,
                'message'   => 'Something went wrong. Please try again later!'
            ], $status);
        });
    }
}
