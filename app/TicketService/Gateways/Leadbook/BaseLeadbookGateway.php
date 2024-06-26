<?php

namespace App\TicketService\Gateways\Leadbook;

use App\TicketService\Models\Event;
use App\TicketService\Models\Place;
use App\TicketService\Models\Reservation;
use App\TicketService\Models\Show;
use App\TicketService\TicketServiceException;
use App\TicketService\TicketServiceLogger;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class BaseLeadbookGateway
 * @package App\TicketService\Gateways\Leadbook
 */
class BaseLeadbookGateway
{
    protected TicketServiceLogger $logger;

    public function __construct()
    {
        $this->logger = new TicketServiceLogger();
    }

    protected function showsValidationRules(): array
    {
        return [
            "response"          => "required|array",
            "response.*.id"     => "required|int",
            "response.*.name"   => "required|string",
        ];
    }

    protected function eventsValidationRules(): array
    {
        return [
            "response"          => "required|array",
            "response.*.id"     => "required|int",
            "response.*.showId" => "required|int",
            "response.*.date"   => "required|string",
        ];
    }

    protected function placesValidationRules(): array
    {
        return [
            "response"                  => "required|array",
            "response.*.id"             => "required|int",
            "response.*.x"              => "required|numeric",
            "response.*.y"              => "required|numeric",
            "response.*.width"          => "required|numeric",
            "response.*.height"         => "required|numeric",
            "response.*.is_available"   => "required|boolean",
        ];
    }

    protected function reservationValidationRules(): array
    {
        return [
            "response"                  => "required|array",
            "response.success"          => "required|boolean",
            "response.reservation_id"   => "required|string",
        ];
    }

    /**
     * @throws TicketServiceException
     */
    protected function validated(array $response, array $validationRules): array
    {
        try {
            $validated = Validator::make($response, $validationRules)->validate();
        } catch (ValidationException $exception) {
            $errorMessage = $response["error"] ?? $exception->getMessage();
            $this->logger->error($errorMessage, ["response" => $response]);
            throw new TicketServiceException($errorMessage);
        }

        return $validated;
    }

    protected function showsFromValidated(array $validated): array
    {
        $shows = [];

        foreach ($validated["response"] as $show) {
            $shows[$show["id"]] = new Show(
                $show["id"],
                $show["name"]
            );
        }

        return $shows;
    }

    protected function eventsFromValidated(array $validated): array
    {
        $events = [];

        foreach ($validated["response"] as $event) {
            $events[$event["id"]] = new Event(
                $event["id"],
                $event["showId"],
                $event["date"]
            );
        }

        return $events;
    }

    protected function placesFromValidated(array $validated): array
    {
        $places = [];

        foreach ($validated["response"] as $place) {
            $places[$place["id"]] = new Place(
                $place["id"],
                $place["x"],
                $place["y"],
                $place["width"],
                $place["height"],
                $place["is_available"],
            );
        }

        return $places;
    }

    protected function reservationFromValidated(array $validated): array
    {
        return [
            "reservation_id" => new Reservation(
                $validated["response"]["reservation_id"]
            )
        ];
    }
}


