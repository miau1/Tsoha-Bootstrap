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

$routes->get('/tuote/:id/muokkaa', function($id) {
    TuoteController::edit($id);
});

$routes->post('/tuote/:id/muokkaa', function($id) {
    TuoteController::update($id);
});

$routes->post('/tuote/:id/poista', function($id) {
    TuoteController::destroy($id);
});

$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

