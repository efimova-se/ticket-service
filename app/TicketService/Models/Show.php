<?php

namespace App\TicketService\Models;

/**
 * Class Show
 * @package App\TicketService\Models
 */
class Show
{
    public int      $id;
    public string   $name;

    public function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }
}
