<?php

namespace App\TicketService\Requests;

/**
 * Class ReserveEventRequest
 * @package App\TicketService\Requests
 */
class ReserveEventRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "name"      => "required|string|max:255",
            "places"    => "required|array",
            "places.*"  => "int",
        ];
    }
}
