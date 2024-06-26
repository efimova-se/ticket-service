<?php

namespace App\TicketService;

use Illuminate\Http\JsonResponse;

/**
 * Class TicketServiceResponse
 * @package App\TicketService
 */
class TicketServiceResponse
{
    public function success(array $data): JsonResponse
    {
        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }

    public function error(string $message): JsonResponse
    {
        return response()->json([
            "success" => false,
            "error" => $message
        ]);
    }
}
