<?php

/**
 * Kontrolleri vastaa vain Tilaustuotteen poistamisesta. Uuden Tilaustuote-yhteyden 
 * luominen tapahtuu aina uuden tilauksen teon yhteydessä. 
 */
class TilaustuoteController extends BaseController{

    public static function destroy($tilaus_id, $tuote_id) {
        self::check_logged_in();
        $tilaustuote = new Tilaustuote(array('tilaus_id' => $tilaus_id, 'tuote_id' => $tuote_id));
        $tilaustuote->destroy();
        
        Redirect::to('/tilaus/'.$tilaus_id.'/muokkaa', array('message' => 'Tuote poistettu!'));
    }
    
}

