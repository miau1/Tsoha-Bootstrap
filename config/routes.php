<?php

$routes->get('/', function() {
    TuoteController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/tuote', function() {
    TuoteController::index();
});

$routes->post('/tuote', function() {
    TuoteController::store();
});

$routes->get('/tuote/lisaa', function() {
    TuoteController::create();
});


$routes->get('/tuote/:id', function($id) {
    TuoteController::show($id);
});

$routes->get('/tuote/1/muokkaa', function() {
    HelloWorldController::muokkaa();
});

$routes->get('/login', function() {
    HelloWorldController::kirjaudu();
});

