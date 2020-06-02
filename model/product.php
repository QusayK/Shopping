<?php
    class Product {

        private $conn;
        private $table = "products";

        public $id;
        public $type;
        public $price;
        public $rating;

        public function __construct($db) {

            $this->conn = $db;
        }

        public function read() {

            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY added_date DESC';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single() {

            $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ' . $this->id . ' LIMIT 1';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->type = $row['type'];
            $this->price = $row['price'];
            $this->rating = $row['rating'];
        }
    }

?>