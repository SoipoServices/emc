<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\LogoutDisabledUsers::class,
        ]);
        $middleware->trustProxies(at: '*');

        // Register middleware aliases
        $middleware->alias([
            'user.ownership' => \App\Http\Middleware\EnsureUserOwnership::class,
        ]);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command(\Spatie\Health\Commands\RunHealthChecksCommand::class)->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            if ($e->getStatusCode() === 413) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
            }
        });
    })->create();
