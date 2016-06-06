<?php

class TuoteController extends BaseController {

    public static function index() {
        $tuotteet = Tuote::all();
        View::make('tuote/index.html', array('tuotteet' => $tuotteet));
    }

    public static function show($id) {
        $tuote = Tuote::find($id);
        View::make('tuote/show.html', array('tuote' => $tuote));
    }
    
    public static function create() {
        View::make('tuote/new.html');
    }

    public static function store() {
        $params = $_POST;
        $tuote = new Tuote(array(
            'pnumber' => $params['pnumber'],
            'pname' => $params['pname'],
            'price' => $params['price'],
            'description' => $params['description'],
            'ptype' => $params['ptype'],
        ));
        
        $tuote->save();
        
        Redirect::to('/tuote/' . $tuote->id, array('message' => 'Uusi tuote lisätty!'));
    }

}
