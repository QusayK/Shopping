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

            $query = 'SELECT product_id, ROUND(AVG(rating), 1) AS rating, COUNT(rating) AS ratings_num 
            FROM ' . $this->table . ' WHERE product_id = :product_id';

            $stmt = $this->conn->prepare($query);
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));

            $stmt->execute(['product_id' => $this->product_id]);

            return $stmt;
        }

        public function read_single() {

            $query = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id AND product_id = :product_id';

            $stmt = $this->conn->prepare($query);

            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

            $stmt->execute(['user_id' => $this->user_id, 'product_id' => $this->product_id]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->rating = $row['rating'];
        }

        public function create() {
            $query = 'INSERT INTO `' . $this->table . 
            '`SET user_id = :user_id, product_id = :product_id, rating = :rating';

            $stmt = $this->conn->prepare($query);

            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->rating = htmlspecialchars(strip_tags($this->rating));

            if ($stmt->execute(['user_id' => $this->user_id, 'product_id' => $this->product_id, 'rating' => $this->rating])) {

                return true;
            } else {

                printf('Error: %s.\n'. $stmt->error);
                return false;
            }
        }

        public function update() {

            $query = 'UPDATE ' . $this->table . ' SET rating = :rating WHERE user_id = :user_id AND product_id = :product_id';

            $stmt = $this->conn->prepare($query);

            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->rating = htmlspecialchars(strip_tags($this->rating));

            if ($stmt->execute(['rating' => $this->rating, 'user_id' => $this->user_id, 'product_id' => $this->product_id])) {

                return true;
            } else {

                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }
    }
?>