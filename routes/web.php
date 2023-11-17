<?php

declare(strict_types=1);

use App\Http\Controllers\Web\Auth\GitHub;
use Illuminate\Support\Facades\Route;

Route::prefix('auth/github')->as('pages:auth:github:')->group(static function (): void {
    Route::get('redirect', GitHub\RedirectController::class)->name('redirect');
    Route::get('callback', GitHub\CallbackController::class)->name('callback');
});
