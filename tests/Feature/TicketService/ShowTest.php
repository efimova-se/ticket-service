<?php

namespace Tests\Feature\TicketService;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * Class ShowTest
 * @package Tests\Feature\TicketService
 */
class ShowTest extends TestCase
{
    /**
     * Test for show find method
     */
    public function test_find(): void
    {
        $response = $this->getJson("/api/show");

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where("success", true)
                    ->has("results", 3)
                    ->has("results.0", fn (AssertableJson $json) =>
                        $json->where("id", 1)
                            ->where("name", "Show #1")
                    )
                    ->has("results.1", fn (AssertableJson $json) =>
                        $json->where("id", 2)
                            ->where("name", "Show #2")
                    )
                    ->has("results.2", fn (AssertableJson $json) =>
                        $json->where("id", 3)
                            ->where("name", "Show #3")
                    )
            );
    }

    /**
     * Test for show read method
     */
    public function test_read(): void
    {
        $response = $this->getJson("/api/show/1");

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where("success", true)
                    ->where("results.id", 1)
                    ->where("results.name", "Show #1")
                    ->has("results.events", 3)
                    ->has("results.events.0", fn (AssertableJson $json) =>
                        $json->where("id", 1)
                            ->where("showId", 1)
                            ->where("date", "2024-06-27 00:02:50")
                        )
            );
    }
}
