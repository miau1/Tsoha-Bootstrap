<?php


/**
 * Luokka kuvaa Tilaustuote-liitostaulun riviä.
 */
class Tilaustuote extends BaseModel{
    
    public $tilaus_id, $tuote_id;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tilaustuote');
        $query->execute();
        $rows = $query->fetchAll();
        $ttuotteet = array();
        
        foreach ($rows as $row) {
            $ttuotteet[] = new Pizzatayte(array(
                'tilaus_id' => $row['tilaus_id'],
                'tuote_id' => $row['tuote_id']
            ));
        }
        
        return $ttuotteet;
    }
    
   
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tilaustuote(tilaus_id, tuote_id) VALUES (:tilaus_id, :tuote_id)');
        $query->execute(array('tilaus_id' => $this->tilaus_id, 'tuote_id' => $this->tuote_id));
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tilaustuote WHERE tilaus_id = :tilaus_id AND tuote_id = :tuote_id');
        $query->execute(array('tilaus_id' => $this->tilaus_id, 'tuote_id' => $this->tuote_id));
    }
}

