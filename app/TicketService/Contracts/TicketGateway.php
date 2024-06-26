<?php

namespace App\TicketService\Contracts;

use App\TicketService\Models\ReservationData;

/**
 * Interface TicketGateway
 * @package App\TicketService\Contracts
 */
interface TicketGateway
{
    public function shows(): array;
    public function events(int $showId): array;
    public function places(int $eventId): array;
    public function reservation(int $eventId, ReservationData $reservationData): array;
}
