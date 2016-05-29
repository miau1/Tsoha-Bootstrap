<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/tuote', function(){
      HelloWorldController::tuotelista();
  });
  
  $routes->get('/tuote/1', function(){
      HelloWorldController::nayta();
  });
  
  $routes->get('/tuote/1/muokkaa', function(){
      HelloWorldController::muokkaa();
  });
  
  $routes->get('/tuote/lisaa', function(){
      HelloWorldController::lisaa();
  });
  
  $routes->get('/login', function(){
      HelloWorldController::kirjaudu();
  });
  
