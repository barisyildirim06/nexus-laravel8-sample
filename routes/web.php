<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test;

//İlk test controllers içindeki file ismi.
//İkinci test file içindeki methodun ismi string olarak.
Route::get('/test',[Test::class, 'test']);
