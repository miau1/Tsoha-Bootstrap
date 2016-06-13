<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        $pizza = new Tuote(array(
            'pnumber' => 5,
            'pname' => 'p',
            'price' => 7,
            'description' => 'll',
            'ptype' => 'pi'
        ));
        $errors = $pizza->errors();
        
        Kint::dump($errors);
    }

    public static function tuotelista() {
        View::make('suunnitelmat/tuotelista.html');
    }

    public static function muokkaa() {
        View::make('suunnitelmat/muokkaus.html');
    }

    public static function lisaa() {
        View::make('suunnitelmat/lisays.html');
    }

    public static function kirjaudu() {
        View::make('suunnitelmat/kirjautuminen.html');
    }

    public static function nayta() {
        View::make('suunnitelmat/nayta.html');
    }

}
