<?php

class Tuote extends BaseModel {

    public $id, $pnumber, $pname, $price, $description, $ptype;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_number', 'validate_name', 'validate_price',
            'validate_description', 'validate_type');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tuote ORDER BY pnumber ASC');
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
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Tuote SET pnumber=:pnumber, pname=:pname, price=:price, description=:description, ptype=:ptype WHERE id = :id RETURNING id');
        $query->execute(array('id' => $this->id, 'pnumber' => $this->pnumber, 'pname' => $this->pname, 'price' => $this->price, 'description' => $this->description, 'ptype' => $this->ptype));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tuote WHERE id = :id RETURNING id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function validate_number() {
        $errors = array();
        if (!$this->validate_num($this->pnumber)) {
            $errors[] = 'Numeron tulee olla numero!';
        }
        return $errors;
    }
    
    public function validate_name() {
        $errors = array();
        if(!$this->validate_str_len($this->pname, 3)){
            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä pitkä!';
        }
        return $errors;
    }
    
    public function validate_price() {
        $errors = array();
        if (!$this->validate_num($this->price)) {
            $errors[] = 'Hinnan tulee olla numero!';
        }
        return $errors;
    }
    
    public function validate_description() {
        $errors = array();
        if(!$this->validate_str_len($this->description, 3)){
            $errors[] = 'Kuvauksen tulee olla vähintään kolme merkkiä pitkä!';
        }
        return $errors;
    }
    
    public function validate_type() {
        $errors = array();
        if(!$this->validate_str_len($this->ptype, 3)){
            $errors[] = 'Tyypin tulee olla vähintään kolme merkkiä pitkä!';
        }
        return $errors;
    }
}
