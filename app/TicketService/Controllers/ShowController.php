<?php

namespace App\TicketService\Controllers;

use App\TicketService\Services\EventService;
use App\TicketService\Services\ShowService;
use App\TicketService\TicketServiceException;
use Illuminate\Http\JsonResponse;

/**
 * Class ShowController
 * @package App\TicketService\Controllers
 */
class ShowController extends BaseController
{
    /**
     * @param ShowService $showService
     * @return JsonResponse
     */
    public function find(ShowService $showService): JsonResponse
    {
        try {
            $shows = $showService->shows();
        } catch (TicketServiceException $exception) {
            return $this->errorResponse($exception->getMessage());
        }

        $response = $shows;

        return $this->successResponse($response);
    }

    /**
     * @param int $id
     * @param ShowService $showService
     * @param EventService $eventService
     * @return JsonResponse
     */
    public function read(int $id, ShowService $showService, EventService $eventService): JsonResponse
    {
        try {
            $show   = $showService->showById($id);
            $events = $eventService->eventsByShowId($id);
        } catch (TicketServiceException $exception) {
            return $this->errorResponse($exception->getMessage());
        }

        $response = (array)$show;
        $response["events"] = $events;

        return $this->successResponse($response);
    }
}
