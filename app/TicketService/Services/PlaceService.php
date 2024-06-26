<?php

namespace App\TicketService\Services;

use App\TicketService\Models\ReservationData;

/**
 * Class PlaceService
 * @package App\TicketService\Services
 */
class PlaceService extends BaseTicketService
{
    public function placesByEventId(int $eventId): array
    {
        $places = $this->gateway->places($eventId);

        return array_values($places);
    }

    public function reservation(int $eventId, ReservationData $reservationData): array
    {
        return $this->gateway->reservation($eventId, $reservationData);
    }
}
