<?php

namespace App\TicketService\Models;

/**
 * Class Reservation
 * @package App\TicketService\Models
 */
class Reservation
{
    public string   $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
