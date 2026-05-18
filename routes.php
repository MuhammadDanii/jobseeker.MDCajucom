<?php

$router->get('/', 'HomeController@index');
$router->get('/listings/create', 'ListingController@create');
$router->get('/listings', 'ListingController@index');
$router->get('/listing/{id}', 'ListingController@show');
$router->post('/listings', 'ListingController@store');


// Register
$router->get('/auth/register', 'AuthController@register');
$router->post('/auth/register', 'AuthController@registerUser');

// Login
$router->get('/auth/login', 'AuthController@login');
$router->post('/auth/login', 'AuthController@authenticate');

// Logout
$router->post('/auth/logout', 'AuthController@logout');

// Edit Listing Routes
$router->get('/listings/edit/{id}', 'ListingController@edit');
$router->post('/listings/update/{id}', 'ListingController@update');