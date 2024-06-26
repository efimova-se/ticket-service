<?php

namespace App\TicketService;

use App\TicketService\Utils\Token;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class TicketServiceLogger
 * @package App\TicketService
 */
class TicketServiceLogger
{
    private string $hash;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->hash = Token::generate(6);
    }

    public function hash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function info(string $message, $context = [])
    {
        Log::channel("ticket_service")->info("{$this->hash} $message", $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function error(string $message, $context = [])
    {
        Log::channel("ticket_service")->error("{$this->hash} $message", $context);
    }
}
