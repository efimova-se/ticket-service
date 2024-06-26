<?php

namespace App\TicketService\Models;

/**
 * Class Place
 * @package App\TicketService\Models
 */
class Place
{
    public int      $id;
    public float    $x;
    public float    $y;
    public float    $width;
    public float    $height;
    public bool     $is_available;

    public function __construct(int $id, float $x, float $y, float $width, float $height, bool $isAvailable)
    {
        $this->id           = $id;
        $this->x            = $x;
        $this->y            = $y;
        $this->width        = $width;
        $this->height       = $height;
        $this->is_available = $isAvailable;
    }
}
