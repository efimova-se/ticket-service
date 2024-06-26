<?php

namespace App\TicketService\Gateways\Leadbook;

use App\TicketService\TicketServiceException;
use App\TicketService\TicketServiceLogger;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Class Client
 * @package App\TicketService\Gateways\Leadbook
 */
class Client
{
    private TicketServiceLogger $logger;

    private string  $apiUrl;
    private string  $token;

    public function __construct(string $apiUrl, string $token, TicketServiceLogger $logger)
    {
        $this->apiUrl   = $apiUrl;
        $this->token    = $token;
        $this->logger   = $logger;
    }

    /**
     * @throws TicketServiceException
     */
    public function get(string $apiMethod, array $params = []): array
    {
        return $this->request("get", $apiMethod, $params);
    }

    /**
     * @throws TicketServiceException
     */
    public function post(string $apiMethod, array $params = []): array
    {
        return $this->request("post", $apiMethod, $params, true);
    }

    /**
     * @throws TicketServiceException
     */
    private function request(string $httpMethod, string $apiMethod, array $params, bool $asForm = false): array
    {
        $url = $this->apiUrl . $apiMethod;

        $response = Http::withToken($this->token);

        if ($asForm) {
            $response = $response->asForm();
        }

        $response = $response->{$httpMethod}($url, $params);
        $responseHttpStatus = $response->status();

        $this->logRequest($httpMethod, $url, $params, $responseHttpStatus);

        $this->ensureCorrectStatus($response);
        $this->ensureIsJson($response);

        return $response->json();
    }

    /**
     * @throws TicketServiceException
     */
    private function ensureCorrectStatus(Response $response): void
    {
        if ($response->serverError()) {
            $this->logError("Server error", $response->body());
            throw new TicketServiceException("Server error.");
        }

        if ($response->clientError()) {
            $this->logError("Client error", $response->body());
            throw new TicketServiceException("Client error.");
        }
    }

    /**
     * @throws TicketServiceException
     */
    private function ensureIsJson(Response $response): void
    {
        if (! is_array($response->json())) {
            $this->logError("Data is not a valid json", $response->body());
            throw new TicketServiceException("Data is not a valid json.");
        }
    }

    private function logRequest(string $httpMethod, string $url, array $params, int $responseHttpStatus): void
    {
        $message = "{$responseHttpStatus} {$httpMethod} {$url}";

        $this->logger->info($message, $params);
    }

    private function logError(string $message, string $responseBody): void
    {
        $this->logger->error($message, ["response_body" => $responseBody]);
    }
}
