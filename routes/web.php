<?php

use App\Http\Controllers\FlowchartController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('flowchart')->group(function () {
    Route::get('/listing', [FlowchartController::class, 'listing'])->name("flowchart.listing");
});
