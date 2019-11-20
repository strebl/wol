<?php

use App\Computer;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/72c112c55cb41d20df06b27e535428c78bee804d', function (\Phpwol\Factory $phpwol) {
    $magicPacket = $phpwol->magicPacket();
    $computer = Computer::find(1);

    if ($computer->use_broadcast) {
        $result = $magicPacket->send($computer->mac, $computer->broadcast);
    } else {
        $result = $magicPacket->send($computer->mac, $computer->ip, $computer->subnet);
    }

    if ($result) {
        return response('Done', 200);
    } else {
        return response('Boot request failed', 503);
    }
});
