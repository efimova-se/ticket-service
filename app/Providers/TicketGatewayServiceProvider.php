<?php

namespace App\Providers;

use App\TicketService\Contracts\TicketGateway;
use App\TicketService\Gateways\Leadbook\LeadbookGateway;
use Illuminate\Support\ServiceProvider;

/**
 * Class TicketGatewayServiceProvider
 * @package App\Providers
 */
class TicketGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TicketGateway::class, LeadbookGateway::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
