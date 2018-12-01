<?php

Route::any('{all}', function () {
    return view('welcome');
})->where(['all' => '.*']);
