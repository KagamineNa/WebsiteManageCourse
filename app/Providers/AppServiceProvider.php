<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Vui lòng kích hoạt tài khoản')
                ->line('Nhấn vào nút bên dưới để kích hoạt tài khoản của bạn.')
                ->action('Kích hoạt tài khoản', $url)
                ->line('Nếu bạn không tạo tài khoản, vui lòng bỏ qua email này.');
        });
    }
}
