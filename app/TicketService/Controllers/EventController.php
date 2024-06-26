<?php

namespace App\TicketService\Controllers;

use App\TicketService\Models\ReservationData;
use App\TicketService\Requests\ReserveEventRequest;
use App\TicketService\Services\EventService;
use App\TicketService\Services\PlaceService;
use App\TicketService\TicketServiceException;
use Illuminate\Http\JsonResponse;

/**
 * Class EventController
 * @package App\TicketService\Controllers
 */
class EventController extends BaseController
{
    /**
     * @param int $showId
     * @param int $id
     * @param EventService $eventService
     * @param PlaceService $placeService
     * @return JsonResponse
     */
    public function read(int $showId, int $id, EventService $eventService, PlaceService $placeService): JsonResponse
    {
        try {
            $event  = $eventService->eventByIds($showId, $id);
            $places = $placeService->placesByEventId($id);
        } catch (TicketServiceException $exception) {
            return $this->errorResponse($exception->getMessage());
        }

        $response = (array)$event;
        $response["places"] = $places;

        return $this->successResponse($response);
    }

    /**
     * @param int $id
     * @param ReserveEventRequest $request
     * @param PlaceService $placeService
     * @return JsonResponse
     */
    public function reserve(int $id, ReserveEventRequest $request, PlaceService $placeService): JsonResponse
    {
        try {
            $name   = $request->get("name");
            $places = $request->get("places");
            $reservationData    = new ReservationData($name, $places);
            $reservation        = $placeService->reservation($id, $reservationData);
        } catch (TicketServiceException $exception) {
            return $this->errorResponse($exception->getMessage());
        }

        $response = $reservation;

        return $this->successResponse($response);
    }
}
