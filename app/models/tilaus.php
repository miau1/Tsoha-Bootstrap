<?php

/**
 * Luokka kuvaa asiakkaan tekemää tilausta.
 */
class Tilaus extends BaseModel {

    public $id, $worker_id, $customer, $phone, $address, $ordered, $delivered, $price, $problems, $discount;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_customer', 'validate_phone', 'validate_address');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tilaus ORDER BY ordered');
        $query->execute();
        $rows = $query->fetchAll();
        $tilaukset = array();

        foreach ($rows as $row) {
            $tilaukset[] = new Tilaus(array(
                'id' => $row['id'],
                'worker_id' => $row['worker_id'],
                'customer' => $row['customer'],
                'phone' => $row['phone'],
                'address' => $row['address'],
                'ordered' => $row['ordered'],
                'delivered' => $row['delivered'],
                'price' => $row['price'],
                'problems' => $row['problems'],
                'discount' => $row['discount']
            ));
        }

        return $tilaukset;
    }

    /**
     * Metodi hakee kaikki tuotteet, jotka kuuluvat tilaukseen käyttämällä Tuote-
     * taulua ja Tilaustuote-liitostaulua.
     * 
     * @param type $id Tilauksen id
     * @return \Tuote Tuotteet taulukossa
     */
    public static function tuotteet($id) {
        $query = DB::connection()->prepare('SELECT Tuote.id, Tuote.pname, Tuote.price FROM Tilaustuote, Tuote WHERE Tilaustuote.tilaus_id = :id AND Tuote.id = Tilaustuote.tuote_id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $tuotteet = array();
        foreach ($rows as $row) {
            $tuotteet[] = new Tuote(array(
                'id' => $row['id'],
                'pname' => $row['pname'],
                'price' => $row['price']
            ));
        }
        return $tuotteet;
    }

    /**
     * Palauttaa kaikki tuotteet, jotka eivät ole tilauksessa.
     * 
     * @param type $id Tilauksen id
     * @return \Tuote Tuotteet taulukossa
     */
    public static function kuulumattomatTuotteet($id) {
        $query = DB::connection()->prepare('SELECT Tuote.id, Tuote.pname, Tuote.price FROM Tuote WHERE Tuote.id NOT IN (SELECT Tuote.id FROM Tilaustuote, Tuote WHERE Tilaustuote.tilaus_id = :id AND Tuote.id = Tilaustuote.tuote_id)');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $tuotteet = array();
        foreach ($rows as $row) {
            $tuotteet[] = new Tuote(array(
                'id' => $row['id'],
                'pname' => $row['pname'],
                'price' => $row['price']
            ));
        }
        return $tuotteet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tilaus WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $tilaus = new Tilaus(array(
                'id' => $row['id'],
                'worker_id' => $row['worker_id'],
                'customer' => $row['customer'],
                'phone' => $row['phone'],
                'address' => $row['address'],
                'ordered' => $row['ordered'],
                'delivered' => $row['delivered'],
                'price' => $row['price'],
                'problems' => $row['problems'],
                'discount' => $row['discount']
            ));
            return $tilaus;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tilaus (customer, phone, address, ordered, price, problems, discount) VALUES (:customer, :phone, :address, CURRENT_TIMESTAMP(0), :price, :problems, :discount) RETURNING id');
        $query->execute(array('customer' => $this->customer, 'phone' => $this->phone, 'address' => $this->address, 'price' => $this->price, 'problems' => $this->problems, 'discount' => $this->discount));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update($bool) {
        if ($bool == "true") {
            $query = DB::connection()->prepare('UPDATE Tilaus SET worker_id=:worker_id, customer=:customer, phone=:phone, address=:address, delivered=CURRENT_TIMESTAMP(0), price=:price, problems=:problems, discount=:discount WHERE id = :id RETURNING id');
            $query->execute(array('id' => $this->id, 'worker_id' => $this->worker_id, 'customer' => $this->customer, 'phone' => $this->phone, 'address' => $this->address, 'price' => $this->price, 'problems' => $this->problems, 'discount' => $this->discount));
            $row = $query->fetch();
            $this->id = $row['id'];
        } else {
            $query = DB::connection()->prepare('UPDATE Tilaus SET worker_id=:worker_id, customer=:customer, phone=:phone, address=:address, price=:price, problems=:problems, discount=:discount WHERE id = :id RETURNING id');
            $query->execute(array('id' => $this->id, 'worker_id' => $this->worker_id, 'customer' => $this->customer, 'phone' => $this->phone, 'address' => $this->address, 'price' => $this->price, 'problems' => $this->problems, 'discount' => $this->discount));
            $row = $query->fetch();
            $this->id = $row['id'];
        }
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tilaus WHERE id = :id RETURNING id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_customer() {
        $errors = array();
        if (!$this->validate_str_len($this->customer, 3)) {
            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä pitkä!';
        }
        return $errors;
    }

    public function validate_phone() {
        $errors = array();
        if (!$this->validate_str_len($this->phone, 6)) {
            $errors[] = 'Numeron tulee olla vähintään kuusi merkkiä pitkä!';
        }
        return $errors;
    }

    public function validate_address() {
        $errors = array();
        if (!$this->validate_str_len($this->address, 6)) {
            $errors[] = 'Osoitteen tulee olla vähintään kuusi merkkiä pitkä!';
        }
        return $errors;
    }

}
