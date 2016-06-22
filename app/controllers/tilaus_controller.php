<?php

/**
 * Kontrolleri huolehtii tilauksen toiminnoista.
 */
class TilausController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $tilaukset = Tilaus::all();
        View::make('tilaus/index.html', array('tilaukset' => $tilaukset));
    }

    public static function show($id) {
        self::check_logged_in();
        $tilaus = Tilaus::find($id);
        $tyont = User::find($tilaus->worker_id);
        $tuotteet = Tilaus::tuotteet($id);
        View::make('tilaus/show.html', array('tilaus' => $tilaus, 'tuotteet' => $tuotteet, 'tyont' => $tyont));
    }
    
    public static function kuitti($id) {
        self::check_logged_in();
        $tilaus = Tilaus::find($id);
        $loppusumma = (int)$tilaus->price - (int)$tilaus->discount;
        $tuotteet = Tilaus::tuotteet($id);
        View::make('tilaus/kuitti.html', array('tilaus' => $tilaus, 'tuotteet' => $tuotteet, 'tilaus' => $tilaus, 'loppusumma' => $loppusumma));
    }

    public static function create() {
        $tuotteet = Tuote::all();
        View::make('tilaus/new.html', array('tuotteet' => $tuotteet));
    }

    /**
     * Tilauksen teon yhteydessä saadaan myös lista tilaukseen kuuluvista tuotteista,
     * joista jokaisen id:n perusteella lisätään Tilaustuote-liitostauluun uusi
     * rivi.
     */
    public static function store() {
        $params = $_POST;

        $tuotteet = $params['tuotteet'];
        $hinta = 0;
        $tilatut = array();
        foreach ($tuotteet as $id){
            if ((int)$id!=0){
                $tuote = Tuote::find($id);
                $hinta = $hinta + (int)$tuote->price;
                $tilatut[] = $tuote;
            }
        }
        $attributes = array(
            'customer' => $params['customer'],
            'phone' => $params['phone'],
            'address' => $params['address'],
            'price' => $hinta,
            'problems' => $params['problems'],
            'discount' => $params['discount'],
        );

        $tilaus = new Tilaus($attributes);

        $errors = $tilaus->errors();
        if (count($errors) == 0 && count($tuotteet) > 1) {
            $tilaus->save();

            foreach ($tuotteet as $tuote) {
                if ((int) $tuote != 0) {
                    $tilaustuote = new Tilaustuote(array('tilaus_id' => $tilaus->id, 'tuote_id' => (int) $tuote));
                    $tilaustuote->save();
                }
            }
            View::make('tilaus/yhteenveto.html', array('message' => 'Tilaus tehty!', 'attributes' => $attributes, 'tilatut' => $tilatut));
        } else {
            if (count($tuotteet) == 1) {
                $errors[] = 'Valitse vähintään yksi tuote!';
            }
            View::make('tilaus/new.html', array('errors' => $errors, 'attributes' => $attributes, 'tuotteet' => Tuote::all()));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $tilaus = Tilaus::find($id);
        $tuotteet = Tilaus::tuotteet($id);
        $kaikki_tuotteet = Tilaus::kuulumattomatTuotteet($id);
        $tyont = User::all();
        View::make('tilaus/edit.html', array('attributes' => $tilaus, 'tuotteet' => $tuotteet, 'kaikki_tuotteet' => $kaikki_tuotteet, 'tyont' => $tyont));
    }

    /**
     * Myös editoinnissa voidaan lisätä uusia tuotteita samalla tavalla, kuin
     * uuden tuotteet lisäämisessä. Liitostaulun käsittely pitää vielä tehdä
     * erilliseksi metodiksi koodin siistiseksi.
     * @param type $id
     */
    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        
        $bool = $params['toimit'];
        $tuotteet = $params['tuotteet'];
        $hinta = (int)$params['price'];
        foreach ($tuotteet as $tid){
            if ((int)$tid!=0){
                $tuote = Tuote::find($tid);
                $hinta = $hinta + (int)$tuote->price;
            }
        }
        $attributes = array(
            'id' => $id,
            'worker_id' => $params['tyont'],
            'customer' => $params['customer'],
            'phone' => $params['phone'],
            'address' => $params['address'],
            'ordered' => $params['ordered'],
            'delivered' => $params['delivered'],
            'price' => $hinta,
            'problems' => $params['problems'],
            'discount' => $params['discount']
        );

        $tilaus = new Tilaus($attributes);
        $errors = $tilaus->errors();
        if (count($errors) > 0) {
            View::make('tilaus/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'tuotteet' => $tilaus->tuotteet($id), 'kaikki_tuotteet' => Tilaus::kuulumattomatTuotteet($id), 'tyont' =>User::all()));
        } else {
            $tilaus->update($bool);
            foreach ($tuotteet as $tuote) {
                if ((int) $tuote != 0) {
                    $tilaustuote = new Tilaustuote(array('tilaus_id' => $tilaus->id, 'tuote_id' => (int) $tuote));
                    $tilaustuote->save();
                }
            }
            Redirect::to('/tilaus/' . $tilaus->id, array('message' => 'Tilausta on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();
        $tilaus = new Tilaus(array('id' => $id));
        $tilaus->destroy();

        Redirect::to('/tilaus', array('message' => 'Tilaus on poistettu onnistuneesti!'));
    }

}
