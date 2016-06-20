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
            'pname' => 'pas',
            'price' => 7,
            'description' => 'llasd',
            'ptype' => 'pizza'
        ));
        $pizza->save();
        $errors = $pizza->errors();
        
        $tayte = new Tayte(array(
            'pname' => 'sipuli',
            'description' => 'huhuh'
        ));
        
        $pizzatayte = new Pizzatayte(array(
           'pizza_id' => $pizza->id,
            'tayte_id' => (int)$tayte->id
        ));
        Kint::dump($pizza);
        Kint::dump($tayte);
        Kint::dump($pizzatayte);
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
