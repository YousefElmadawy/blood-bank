<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Handle Spatie Permission exceptions with custom messages
        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'You do not have the required permissions to access this resource.',
                ], 403);
            }

            // If trying to access dashboard, redirect to home/login
            if ($request->is('dashboard') || $request->is('dashboard/*')) {
                if (auth()->check()) {
                    $user = auth()->user();
                    $userRoles = $user->getRoleNames()->join(', ') ?: 'none';

                    return redirect()
                        ->route('login')
                        ->with('error', 'Access Denied: Admin role required. Your roles: ' . $userRoles);
                }

                return redirect()
                    ->route('login')
                    ->with('error', 'Please login as admin to access the dashboard.');
            }

            return redirect()
                ->back()
                ->with('error', 'Access Denied: You do not have the required permissions to perform this action.');
        });

        // Handle role-specific unauthorized access
        $this->renderable(function (\Illuminate\Auth\Access\AuthorizationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Forbidden',
                    'message' => $e->getMessage() ?: 'You are not authorized to access this resource.',
                ], 403);
            }

            // Check if user is trying to access dashboard without admin role
            if ($request->is('dashboard') || $request->is('dashboard/*')) {
                if (auth()->check()) {
                    $user = auth()->user();
                    $userRoles = $user->getRoleNames()->join(', ') ?: 'none';

                    return redirect()
                        ->route('login')
                        ->with('error', 'Access Denied: Admin role required. Your roles: ' . $userRoles);
                }

                return redirect()
                    ->route('login')
                    ->with('error', 'Please login as admin to access the dashboard.');
            }

            return redirect()
                ->back()
                ->with('error', 'Access Denied: ' . ($e->getMessage() ?: 'You are not authorized to perform this action.'));
        });
    }
}
