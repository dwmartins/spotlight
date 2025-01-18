<?php

use App\Http\Middleware\LoadSettings;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(LoadSettings::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Handles routes or pages not found
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if($request->is('api/*')) {
                return response()->json([
                    'message' => trans('messages.ROUTE_NOT_FOUND'),
                    'requested_url' => request()->fullUrl(),
                    'method' => request()->method(),
                    'code' => 404
                ], 404);
            }

            return response()->view('errors.pageNotFound', [
                'message' => trans('messages.PAGE_NOT_FOUND'),
                'seo_title' => trans('messages.SEO_TITLE_PAGE_NOT_FOND')
            ], 404);
        });

        //Handles general errors
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Oops, an error occurred, please try again.'
                ], 500);
            }

            return response()->view('errors.general', [
                'message' => 'Oops, an error occurred, please try again.'
            ], 500);
        });

    })->create();
