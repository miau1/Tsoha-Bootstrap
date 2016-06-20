<?php

/**
 * Kontrolleri huolehtii täytteiden listaamisesta ja näyttämisestä.
 */
class TayteController extends BaseController{
    
    public static function index() {
        $taytteet = Tayte::all();
        View::make('tayte/index.html', array('taytteet' => $taytteet));
    }

    public static function show($id) {
        $tayte = Tayte::find($id);
        $pizzat = Tayte::pizzat($id);
        View::make('tayte/show.html', array('tayte' => $tayte, 'pizzat' => $pizzat));
    }
    
}

