<?php
    class Rating {

        private $conn;
        private $table = "rating";

        public $user_id;
        public $product_id;
        public $rating;

        public function __construct($db) {

            $this->conn = $db;
        }

        public function read() {

            $query = 'SELECT uesr_id, product_id, AVG(rating) AS rating FROM ' . $this->table . ' WEHERE product_id = :product_id';

            $stmt = $this->conn->prepare($query);
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));

            $stmt->execute(['product_id' => $this->product_id]);

            return $stmt;
        }
    }
?>