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
        $attributes =array(
            'pnumber' => $params['pnumber'],
            'pname' => $params['pname'],
            'price' => $params['price'],
            'description' => $params['description'],
            'ptype' => $params['ptype'],
        );
        
        $tuote = new Tuote($attributes);

        $errors = $tuote->errors();

        if (count($errors) == 0) {
            $tuote->save();
            Redirect::to('/tuote/' . $tuote->id, array('message' => 'Uusi tuote lisätty!'));
        } else {
            View::make('tuote/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }

    }
    
    public static function edit($id){
        $tuote = Tuote::find($id);
        View::make('tuote/edit.html', array('attributes' => $tuote));
    }
    
    public static function update($id) {
        $params = $_POST;
        
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
        
        if(count($errors) > 0){
            View::make('tuote/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tuote->update();
            
            Redirect::to('/tuote/' . $tuote->id, array('message' => 'Tuotetta on muokattu onnistuneesti!'));
        }
    }
    
    public static function destroy($id){
        $tuote = new Tuote(array('id' => $id));
        $tuote->destroy();
        
        Redirect::to('/tuote', array('message' => 'Tuote on poistettu onnistuneesti!'));
    }
}
