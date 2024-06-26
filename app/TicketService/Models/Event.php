<?php

namespace App\TicketService\Models;

/**
 * Class Event
 * @package App\TicketService\Models
 */
class Event
{
    public int      $id;
    public int      $showId;
    public string   $date;

    public function __construct(int $id, int $showId, string $date)
    {
        $this->id       = $id;
        $this->showId   = $showId;
        $this->date     = $date;
    }
}
