<?php
    class Product {

        private $conn;
        private $table = "products";

        public $id;
        public $type;
        public $price;

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
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table . '(type, price, added_date)
            VALUES (:type, :price, NOW())';

            $stmt = $this->conn->prepare($query);

            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->price = htmlspecialchars(strip_tags($this->price));

            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':price', $this->price);

            if ($stmt->execute()) {

                return true;
            } else {

                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }

        public function update() {

            $query = 'UPDATE`' . $this->table . 
            '`SET `type` = :type, `price` = :price WHERE `id` = :id';
            
            $stmt = $this->conn->prepare($query);

            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':id', $this->id);

            if ($stmt->execute()) {

                return true;
            } else {

                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }

        public function delete() {

            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            $stmt = $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(':id', $this->id);

            if ($stmt->execute()) {

                return true;
            } else {

                printf("Error: %s.\n". $stmt->error);
                return false;
            }
        }
    }

?>