<?php
    class Classification {

        private $conn;
        private $table = "classification";


        public $id;
        public $favorite;
        public $basket;
        public $purchased;

        public function __construct($db) {

            $this->conn = $db;
        }

        public function read() {

            $query = 'SELECT favorite, basket, purchased FROM ' . $this->table . ' WHERE id = :id';

            $stmt = $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->execute(['id' => $this->id]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            extract($row);

            $this->favorite = $favorite;
            $this->basket = $basket;
            $this->purchased = $purchased;
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table . ' SET id = :id, favorite = :favorite, basket = :basket, purchased = :purchased';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->favorite = htmlspecialchars(strip_tags($this->favorite)); 
            $this->basket = htmlspecialchars(strip_tags($this->basket)); 
            $this->purchased = htmlspecialchars(strip_tags($this->purchased));  

            if ($stmt->execute(['id' => $this->id, 'favorite' => $this->favorite, 'basket' => $this->basket, 'purchased' => $this->purchased])) {

                return true;
            } else {

                printf('Error: %s.\n'. $stmt->error);
                return false;
            } 
        }

        public function update() {

            $query = 'UPDATE ' . $this->table . ' SET favorite = :favorite, basket = :basket, purchased = :purchased WHERE id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->favorite = htmlspecialchars(strip_tags($this->favorite)); 
            $this->basket = htmlspecialchars(strip_tags($this->basket)); 
            $this->purchased = htmlspecialchars(strip_tags($this->purchased));  

            if ($stmt->execute(['favorite' => $this->favorite, 'basket' => $this->basket, 'purchased' => $this->purchased, 'id' => $this->id])) {

                return true;
            } else {

                printf('Error: %s.\n'. $stmt->error);
                return false;
            } 
        }

        public function delete() {

            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            if ($stmt->execute(['id' => $this->id])) {

                return true;
            } else {

                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }
    }
?>