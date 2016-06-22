<?php

/**
 * Luokka kuvaa sovelluksen kirjautuvia käyttäjiä eli työntekijöitä.
 */
class User extends BaseModel {

    public $id, $fullname, $wposition, $location, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
//        $this->validators = array('validate_number', 'validate_name', 'validate_price',
//            'validate_description', 'validate_type');
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tyontekija ORDER BY fullname');
        $query->execute();
        $rows = $query->fetchAll();
        $tyontekijat = array();
        
        foreach ($rows as $row) {
            $tyontekijat[] = new User(array(
                'id' => $row['id'],
                'fullname' => $row['fullname'],
                'wposition' => $row['wposition'],
                'location' => $row['location'],
                'password' => $row['password']
            ));
        }
        
        return $tyontekijat;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tyontekija WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row) {
            $user = new User(array(
                'id' => $row['id'],
                'fullname' => $row['fullname'],
                'wposition' => $row['wposition'],
                'location' => $row['location'],
                'password' => $row['password']
            ));
            
            return $user;
        }
        
        return null;
    }

    public function authenticate($fullname, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Tyontekija WHERE fullname = :fullname AND password = :password LIMIT 1');
        $query->execute(array('fullname' => $fullname, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
            $user = new User(array(
                'id' => $row['id'],
                'fullname' => $row['fullname'],
                'wposition' => $row['wposition'],
                'location' => $row['location'],
                'password' => $row['password'],
            ));
            
            return $user;
            
        } else {
            // Käyttäjää ei löytynyt, palautetaan null
            return null;
        }
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Tyontekija SET fullname=:fullname, wposition=:wposition, location=:location WHERE id = :id RETURNING id');
        $query->execute(array('id' => $this->id, 'fullname' => $this->fullname, 'wposition' => $this->wposition, 'location' => $this->location));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}
