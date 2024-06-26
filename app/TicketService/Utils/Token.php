<?php

namespace App\TicketService\Utils;

use Exception;

/**
 * Class Token
 * @package App\TicketService\Utils
 */
class Token
{
    /**
     * @throws Exception
     */
    public static function generate(int $length): string
    {
        $length = (int) round($length / 2);

        return bin2hex(random_bytes($length));
    }
}
