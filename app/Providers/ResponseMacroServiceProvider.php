<?php

namespace App\Providers;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Send success JSON response with data.
         */
        Response::macro('success', function ($data, $statusCode = HttpResponse::HTTP_OK, $noWrap = false, $message = false) {
            if (is_array($data) && count($data) === 1 && Arr::exists($data, 'message')) {
                return Response::json($data, $statusCode);
            }

            if (! $noWrap) {
                $data = compact('data');
            }

            if ($message) {
                if (is_array($data)) {
                    $data['message'] = $message;
                } else {
                    $data->additional(['message' => $message]);
                }
            }

            return $noWrap ? $data : Response::json($data, $statusCode);
        });

        /**
         * Send error JSON response with single/multiple error statements.
         */
        Response::macro('error', function ($message = false, $errors = [], $statusCode = HttpResponse::HTTP_INTERNAL_SERVER_ERROR) {
            $data = [
                'message' => $message ?: trans('system.error'),
            ];

            if (isset($errors)) {
                $data['errors'] = $errors;
            }

            return Response::json($data, $statusCode);
        });
    }
}
