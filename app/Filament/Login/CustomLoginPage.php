<?php

namespace App\Filament\Login;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Pages\Auth\Login;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class CustomLoginPage extends Login
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/login.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/login.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/login.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        if (! auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        if (! $this->canAcessPanel(auth()->user())) {
            auth()->logout();
            throw ValidationException::withMessages([
                'data.email' => 'Não tem permissão para aceder a esta área',
            ]);
        }

        session()->regenerate();


        return app(LoginResponse::class);
    }

    public function canAcessPanel($user): bool
    {
        $role = '';
        if (str_contains(Filament::getUrl(), 'recepcionista')) {
            $role = 'recepcionista';
        } elseif (str_contains(Filament::getUrl(), 'medico')) {
            $role = 'medico';
        } elseif (str_contains(Filament::getUrl(), 'admin')) {
            $role = 'admin';
        }

        return $user->canUserAccessPanel($role);
    }

}
