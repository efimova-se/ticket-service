<?php

namespace App\TicketService\Services;

use App\TicketService\Contracts\TicketGateway;
use App\TicketService\TicketServiceLogger;

/**
 * Class BaseTicketService
 * @package App\TicketService\Services
 */
class BaseTicketService
{
    protected   TicketGateway       $gateway;
    protected   TicketServiceLogger $logger;

    public function __construct(TicketGateway $ticketGateway)
    {
        $this->gateway  = $ticketGateway;
        $this->logger   = new TicketServiceLogger();
    }
}
