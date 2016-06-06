<?php

class Tuote extends BaseModel {

    public $id, $pnumber, $pname, $price, $description, $ptype;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tuote');
        $query->execute();
        $rows = $query->fetchAll();
        $tuotteet = array();
        
        foreach ($rows as $row) {
            $tuotteet[] = new Tuote(array(
                'id' => $row['id'],
                'pnumber' => $row['pnumber'],
                'pname' => $row['pname'],
                'price' => $row['price'],
                'description' => $row['description'],
                'ptype' => $row['ptype']
            ));
        }
        
        return $tuotteet;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row) {
            $tuote = new Tuote(array(
                'id' => $row['id'],
                'pnumber' => $row['pnumber'],
                'pname' => $row['pname'],
                'price' => $row['price'],
                'description' => $row['description'],
                'ptype' => $row['ptype']
            ));
            
            return $tuote;
        }
        
        return null;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tuote (pnumber, pname, price, description, ptype) VALUES (:pnumber, :pname, :price, :description, :ptype) RETURNING id');
        $query->execute(array('pnumber' => $this->pnumber, 'pname' => $this->pname, 'price' => $this->price, 'description' => $this->description, 'ptype' => $this->ptype));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}
