<?php

/**
 * Pizzataytteen kontrolleri huolehtii vain liitoksen poistamisesta. Uuden pizza-
 * tayte liitoksen teko tapahtuu aina uuden pizzan luonnin yhteydessä.
 */
class PizzatayteController extends BaseController{

    public static function destroy($pizza_id, $tayte_id) {
        self::check_logged_in();
        $pizzatayte = new Pizzatayte(array('pizza_id' => $pizza_id, 'tayte_id' => $tayte_id));
        $pizzatayte->destroy();
        
        Redirect::to('/tuote/'.$pizza_id.'/muokkaa', array('message' => 'Täyte poistettu!'));
    }
    
}

