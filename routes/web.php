<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/test', function () {
  $secret = 'abc123';

  $s = Crypt::encryptString($secret);

  return $s;
});
