<?php

namespace Tests\Feature\TicketService;

use Faker\Factory;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * Class ShowTest
 * @package Tests\Feature\TicketService
 */
class EventTest extends TestCase
{
    /**
     * Test for event read method
     */
    public function test_read(): void
    {
        $response = $this->getJson("/api/event/1/1");

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where("success", true)
                    ->where("results.id", 1)
                    ->where("results.showId", 1)
                    ->where("results.date", "2024-06-27 00:02:50")
                    ->has("results.places", 3)
                    ->has("results.places.0", fn (AssertableJson $json) =>
                        $json->where("id", 1)
                            ->where("x", 0)
                            ->where("y", 0)
                            ->where("width", 20)
                            ->where("height", 20)
                            ->where("is_available", true)
                        )
            );
    }

    /**
     * Test for event reserve method
     */
    public function test_reserve(): void
    {
        $faker = Factory::create();

        $response = $this->postJson("/api/event/1/reserve", [
            "name"      => $faker->name,
            "places"    => [1,2]
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where("success", true)
                    ->has("results.reservation_id.id")
            );
    }
}
