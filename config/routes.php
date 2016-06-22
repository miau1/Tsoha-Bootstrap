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

$routes->post('/logout', function(){
    UserController::logout();
});

$routes->get('/tyontekija', function() {
    UserController::index();
});

$routes->post('/tyontekija/:id/muokkaa', function($id) {
    UserController::update($id);
});

$routes->get('/tayte', function() {
    TayteController::index();
});

$routes->get('/tayte/:id', function($id) {
    TayteController::show($id);
});

$routes->get('/tilaus', function() {
    TilausController::index();
});

$routes->post('/tilaus', function() {
    TilausController::store();
});

$routes->get('/tilaus/lisaa', function() {
    TilausController::create();
});

$routes->get('/tilaus/:id', function($id) {
    TilausController::show($id);
});

$routes->get('/tilaus/:id/kuitti', function($id) {
    TilausController::kuitti($id);
});

$routes->get('/tilaus/:id/muokkaa', function($id) {
    TilausController::edit($id);
});

$routes->post('/tilaus/:id/muokkaa', function($id) {
    TilausController::update($id);
});

$routes->post('/tilaus/:id/poista', function($id) {
    TilausController::destroy($id);
});

$routes->post('/pizzatayte/:pizza_id/:tayte_id/poista', function($pizza_id, $tayte_id) {
    PizzatayteController::destroy($pizza_id, $tayte_id);
});

$routes->post('/tilaustuote/:tilaus_id/:tuote_id/poista', function($tilaus_id, $tuote_id) {
    TilaustuoteController::destroy($tilaus_id, $tuote_id);
});


