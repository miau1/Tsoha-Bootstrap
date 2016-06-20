<?php

/**
 * Luokka kuvaa Pizzatayte-liitostaulua, eli sen avulla pidetään kirjaa, mikä täyte
 * kuuluu mihinkin pitzzan ja päinvastoin.
 */
class Pizzatayte extends BaseModel{
    
    public $pizza_id, $tayte_id;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Pizzatayte');
        $query->execute();
        $rows = $query->fetchAll();
        $ptaytteet = array();
        
        foreach ($rows as $row) {
            $ptaytteet[] = new Pizzatayte(array(
                'pizza_id' => $row['pizza_id'],
                'tayte_id' => $row['tayte_id']
            ));
        }
        
        return $ptaytteet;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (:pizza_id, :tayte_id)');
        $query->execute(array('pizza_id' => $this->pizza_id, 'tayte_id' => $this->tayte_id));
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Pizzatayte WHERE pizza_id = :pizza_id AND tayte_id = :tayte_id');
        $query->execute(array('pizza_id' => $this->pizza_id, 'tayte_id' => $this->tayte_id));
    }
}

