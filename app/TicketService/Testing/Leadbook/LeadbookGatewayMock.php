<?php

namespace App\TicketService\Testing\Leadbook;

use App\TicketService\Contracts\TicketGateway;
use App\TicketService\Models\ReservationData;
use App\TicketService\Gateways\Leadbook\BaseLeadbookGateway;
use App\TicketService\TicketServiceException;

/**
 * Class LeadbookGatewayMock
 * @package App\TicketService\Testing\Leadbook
 */
class LeadbookGatewayMock extends BaseLeadbookGateway implements TicketGateway
{
    /**
     * @throws TicketServiceException
     */
    public function shows(): array
    {
        $showsJson  = file_get_contents(base_path("app/TicketService/Testing/Leadbook/MockData/shows.json"));
        $response   = json_decode($showsJson, true);

        $validationRules    = $this->showsValidationRules();
        $validated          = $this->validated($response, $validationRules);

        return $this->showsFromValidated($validated);
    }

    /**
     * @throws TicketServiceException
     */
    public function events(int $showId): array
    {
        $eventsJson = file_get_contents(base_path("app/TicketService/Testing/Leadbook/MockData/events.json"));
        $response   = json_decode($eventsJson, true);

        $validationRules    = $this->eventsValidationRules();
        $validated          = $this->validated($response, $validationRules);

        return $this->eventsFromValidated($validated);
    }

    /**
     * @throws TicketServiceException
     */
    public function places(int $eventId): array
    {
        $placesJson = file_get_contents(base_path("app/TicketService/Testing/Leadbook/MockData/places.json"));
        $response   = json_decode($placesJson, true);

        $validationRules    = $this->placesValidationRules();
        $validated          = $this->validated($response, $validationRules);

        return $this->placesFromValidated($validated);
    }

    /**
     * @throws TicketServiceException
     */
    public function reservation(int $eventId, ReservationData $reservationData): array
    {
        $reservationJson    = file_get_contents(base_path("app/TicketService/Testing/Leadbook/MockData/reservation.json"));
        $response           = json_decode($reservationJson, true);

        $validationRules    = $this->reservationValidationRules();
        $validated          = $this->validated($response, $validationRules);

        return $this->reservationFromValidated($validated);
    }
}


