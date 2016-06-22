<?php

/**
 * Kontrolleri ohjaa kirjautumistoimintoja, sekä työntekijöiden listausta.
 */
class UserController extends BaseController {

    public static function login() {
        View::make('user/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->fullname . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function index() {
        self::check_logged_in();
        $tyontekijat = User::all();
        View::make('user/index.html', array('tyontekijat' => $tyontekijat));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'fullname' => $params['fullname'],
            'wposition' => $params['wposition'],
            'location' => $params['location']
        );
        $user = new User($attributes);
        $user->update();
        Redirect::to("/tyontekija");
    }

}
