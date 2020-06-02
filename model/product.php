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

            $this->id = $row['id'];
            $this->type = $row['type'];
            $this->price = $row['price'];
            $this->rating = $row['rating'];
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table . ' SET type = :type, price = :price, reating = :rating';

            $stmt = $this->conn->prepare($query);

            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->rating = htmlspecialchars(strip_tags($this->rating));

            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam('price', $this->price);
            $stmt->bindParam('rating', $this->rating);

            $stmt->execute();
            /*if ($stmt->execute()) {

                return true;
            } else {

                printf('Error: %s.\n', $stmt->error);
                return false;
            }*/
        }
    }

?>