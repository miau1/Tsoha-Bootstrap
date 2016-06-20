<?php

/**
 * Kontrolleri huolehtii tuotteiden toiminnoista.
 */
class TuoteController extends BaseController {

    public static function index() {
        $tuotteet = Tuote::all();
        View::make('tuote/index.html', array('tuotteet' => $tuotteet));
    }

    public static function show($id) {
        $tuote = Tuote::find($id);
        $taytteet = Tuote::taytteet($id);
        View::make('tuote/show.html', array('tuote' => $tuote, 'taytteet' => $taytteet));
    }

    public static function create() {
        self::check_logged_in();
        $taytteet = Tayte::all();
        View::make('tuote/new.html', array('taytteet' => $taytteet));
    }

    /**
     * Uuden tuotteen teon yhteydessä saadaan täytteet taulukkona, jos tuotteen
     * tyyppi on Pizza. Jokaisen täytteen kohdalla lisätään uusi rivi Pizzatayte-
     * liitostauluun tuotteen id:n ja taytteen id:n perusteella
     */
    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $taytteet = $params['taytteet'];
        $attributes = array(
            'pnumber' => $params['pnumber'],
            'pname' => $params['pname'],
            'price' => $params['price'],
            'description' => $params['description'],
            'ptype' => $params['ptype']
        );

        $tuote = new Tuote($attributes);
        $errors = $tuote->errors();
        if (count($errors) == 0) {
            $tuote->save();
            if ($tuote->ptype == 'Pizza') {
                foreach ($taytteet as $tayte) {
                    if ((int) $tayte!=0){
                        $pizzatayte = new Pizzatayte(array('pizza_id' => $tuote->id, 'tayte_id' => (int) $tayte));
                        $pizzatayte->save();
                    }
                }
            }
            Redirect::to('/tuote/' . $tuote->id, array('message' => 'Uusi tuote lisätty!'));
        } else {
            View::make('tuote/new.html', array('errors' => $errors, 'attributes' => $attributes, 'taytteet' => Tayte::all()));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $tuote = Tuote::find($id);
        $taytteet = Tuote::taytteet($id);
        $kaikki_taytteet = Tayte::all();
        View::make('tuote/edit.html', array('attributes' => $tuote, 'taytteet' => $taytteet, 'kaikki_taytteet' => $kaikki_taytteet));
    }

    /**
     * Myös tuotetta muokatessa saadaan täytteet taulukkona, jos tuotteen tyyppi
     * on Pizza. Uudet liitostaulurivit luodaan samalla tavalla kuin uuden tuotteen
     * lisäämisessä. Liitostaulurivien lisääminen pitää tehdä omaksi metodikseen
     * koodin siistimiseksi.
     * 
     * @param type $id
     */
    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $taytteet = $params['taytteet'];
        $attributes = array(
            'id' => $id,
            'pnumber' => $params['pnumber'],
            'pname' => $params['pname'],
            'price' => $params['price'],
            'description' => $params['description'],
            'ptype' => $params['ptype']
        );

        $tuote = new Tuote($attributes);
        $errors = $tuote->errors();

        if (count($errors) > 0) {
            View::make('tuote/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tuote->update();
            if ($tuote->ptype == 'Pizza'){
                foreach ($taytteet as $tayte) {
                    if ((int) $tayte!=0){
                        $pizzatayte = new Pizzatayte(array('pizza_id' => $tuote->id, 'tayte_id' => (int) $tayte));
                        $pizzatayte->save();
                    }
                }
            }
            Redirect::to('/tuote/' . $tuote->id, array('message' => 'Tuotetta on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $tuote = new Tuote(array('id' => $id));
        $tuote->destroy();

        Redirect::to('/tuote', array('message' => 'Tuote on poistettu onnistuneesti!'));
    }

}
