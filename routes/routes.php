<?php
use Hasinur\Xspeed\Http\Router;
use Hasinur\Xspeed\Controllers\Home;

Router::get('/', [Home::class, 'index']);
Router::get('/reports', [Home::class, 'show']);
Router::post('/store', [Home::class, 'store']);

Router::cleanup();