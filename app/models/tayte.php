<?php

/**
 * Malli kuvaa pizzaan kuuluvaa täytettä.
 */
class Tayte extends BaseModel{
    
    public $id, $pname, $description;
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tayte');
        $query->execute();
        $rows = $query->fetchAll();
        $taytteet = array();
        
        foreach ($rows as $row) {
            $taytteet[] = new Tayte(array(
                'id' => $row['id'],
                'pname' => $row['pname'],
                'description' => $row['description']
            ));
        }
        
        return $taytteet;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tayte WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row) {
            $tayte = new Tayte(array(
                'id' => $row['id'],
                'pname' => $row['pname'],
                'description' => $row['description']
            ));
            
            return $tayte;
        }
        
        return null;
    }
    
    /**
     * Metodi etsii kaikki pitsat, joissa on tämä täyte käyttäen Tuote-taulua
     * ja Pizzatayte-liitostaulua.
     * @param type $id Täytteen id
     * @return \Tuote Pizzat taulukossa
     */
    public static function pizzat($id) {
        $query = DB::connection()->prepare('SELECT Tuote.id, Tuote.pname FROM Pizzatayte, Tuote WHERE Pizzatayte.tayte_id = :id AND Tuote.id = Pizzatayte.pizza_id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $pizzat = array();
        foreach ($rows as $row) {
            $pizzat[] = new Tuote(array(
                'id' => $row['id'],
                'pname' => $row['pname']
            ));
        }
        return $pizzat;
    }
    
    
}

