<?php

namespace App\TicketService\Gateways\Leadbook;

use App\TicketService\Contracts\TicketGateway;
use App\TicketService\Models\ReservationData;
use App\TicketService\TicketServiceException;

/**
 * Class LeadbookGateway
 * @package App\TicketService\Gateways\Leadbook
 */
class LeadbookGateway extends BaseLeadbookGateway implements TicketGateway
{
    /**
     * @throws TicketServiceException
     */
    public function shows(): array
    {
        $client     = $this->client();
        $response   = $client->get("/shows");

        $validationRules    = $this->showsValidationRules();
        $validated          = $this->validated($response, $validationRules);

        return $this->showsFromValidated($validated);
    }

    /**
     * @throws TicketServiceException
     */
    public function events(int $showId): array
    {
        $client     = $this->client();
        $response   = $client->get("/shows/{$showId}/events");

        $validationRules    = $this->eventsValidationRules();
        $validated          = $this->validated($response, $validationRules);

        return $this->eventsFromValidated($validated);
    }

    /**
     * @throws TicketServiceException
     */
    public function places(int $eventId): array
    {
        $client     = $this->client();
        $response   = $client->get("/events/{$eventId}/places");

        $validationRules    = $this->placesValidationRules();
        $validated          = $this->validated($response, $validationRules);

        return $this->placesFromValidated($validated);
    }

    /**
     * @throws TicketServiceException
     */
    public function reservation(int $eventId, ReservationData $reservationData): array
    {
        $client = $this->client();

        $dataTransformed = [
            "name"      => $reservationData->name,
            "places"    => $reservationData->places,
        ];

        $response = $client->post("/events/{$eventId}/reserve", $dataTransformed);

        $validationRules    = $this->reservationValidationRules();
        $validated          = $this->validated($response, $validationRules);

        return $this->reservationFromValidated($validated);
    }

    /**
     * @throws TicketServiceException
     */
    private function client(): Client
    {
        $apiUrl = config("ticketservice.leadbook.api_url");
        $token  = config("ticketservice.leadbook.token");

        if (! $apiUrl || ! $token) {
            throw new TicketServiceException("No api url or token specified.");
        }

        return new Client($apiUrl, $token, $this->logger);
    }
}


