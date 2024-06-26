<?php

namespace App\TicketService\Services;

use App\TicketService\Models\Event;

/**
 * Class EventService
 * @package App\TicketService\Services
 */
class EventService extends BaseTicketService
{
    public function eventsByShowId(int $showId): array
    {
        $events = $this->gateway->events($showId);

        return array_values($events);
    }

    public function eventByIds(int $showId, int $id): Event
    {
        $events = $this->gateway->events($showId);

        if (! isset($events[$id])) {
            abort(404);
        }

        return $events[$id];
    }
}
