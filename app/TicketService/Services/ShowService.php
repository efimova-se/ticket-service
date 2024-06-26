<?php

namespace App\TicketService\Services;

use App\TicketService\Models\Show;

/**
 * Class ShowService
 * @package App\TicketService\Services
 */
class ShowService extends BaseTicketService
{
    public function shows(): array
    {
        $shows = $this->gateway->shows();

        return array_values($shows);
    }

    public function showById(int $id): Show
    {
        $shows = $this->gateway->shows();

        if (! isset($shows[$id])) {
            abort(404);
        }

        return $shows[$id];
    }
}
