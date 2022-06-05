<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/customers", function () {
    $auth_string = request()->input("auth");
    if ($auth_string === '$2y$10$Wqtzg7YOGlX7MgXMVnubZO7vwAm3Tye5bWbx52ObZwycfegv38xy.') {
        $members = new Collection(\App\Models\membership::all());
        return $members;
    }
    return response()->json(["error" => "unauthorized"], 401);
});
