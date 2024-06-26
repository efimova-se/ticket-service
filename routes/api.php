<?php

use Illuminate\Support\Facades\Route;

Route::group([
    "namespace" => "App\TicketService\Controllers",
], function () {

    Route::get("/show", "ShowController@find");
    Route::get("/show/{id}", "ShowController@read")->where("id", "[0-9]+");

    Route::get("/event/{showId}/{id}", "EventController@read")->where(["showId" => "[0-9]+", "id" => "[0-9]+"]);
    Route::post("/event/{id}/reserve", "EventController@reserve")->where("id", "[0-9]+");

});
