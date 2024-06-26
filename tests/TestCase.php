<?php

namespace Tests;

use App\TicketService\Contracts\TicketGateway;
use App\TicketService\Testing\Leadbook\LeadbookGatewayMock;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->instance(TicketGateway::class, new LeadbookGatewayMock());
    }
}
