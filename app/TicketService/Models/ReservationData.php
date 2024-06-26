<?php

namespace App\TicketService\Models;

/**
 * Class ReservationData
 * @package App\TicketService\Models
 */
class ReservationData
{
    public string   $name;
    public array    $places;

    public function __construct(string $name, array $places)
    {
        $this->name     = $name;
        $this->places   = $places;
    }
}
