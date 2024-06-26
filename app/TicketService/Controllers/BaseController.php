<?php

namespace App\TicketService\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class BaseController
 * @package App\TicketService\Controllers
 */
class BaseController extends Controller
{
    public function successResponse(array $data): JsonResponse
    {
        return response()->json([
            "success" => true,
            "results" => $data
        ]);
    }

    public function errorResponse(string $message): JsonResponse
    {
        return response()->json([
            "success" => false,
            "error" => $message
        ]);
    }
}
