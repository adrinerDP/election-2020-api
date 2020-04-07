<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/regions', ['uses' => 'RegionController@getRegions']);
$router->get('/districts/{regionId}', ['uses' => 'DistrictController@getDistricts']);
$router->get('/candidates/{regionId}/{districtId}', ['uses' => 'CandidateController@getCandidates']);
