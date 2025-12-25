<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        //web: __DIR__.'/../routes/web.php',
        //commands: __DIR__.'/../routes/console.php',
        //health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        ]);

        $middleware->validateCsrfTokens(except: [
            'logout',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Exception $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->back()->withInput(request()->except('_token'))->withError('Invalid token. Please submit the form again');
            };
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->view('errors.404', [], 404);
        });
    })->create();
