<?php
    class Comments {

        private $conn;
        private $table = "comments";

        public $id;
        public $user_id;
        public $product_id;
        public $comment;

        public function __construct($db) {

            $this->conn = $db;
        }

        public function read() {

            $query = 'SELECT * FROM ' . $this->table . ' WHERE product_id = :product_id';

            $stmt = $this->conn->prepare($query);
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $stmt->execute(['product_id' => $this->product_id]);

            return $stmt;
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table. ' SET user_id = :user_id, product_id = :product_id, comment = :comment';

            $stmt = $this->conn->prepare($query);

            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->comment = htmlspecialchars(strip_tags($this->comment));

            if ($stmt->execute(['user_id' => $this->user_id, 'product_id' => $this->product_id, 'comment' => $this->comment])) {

                return true;
            } else {

                printf('Error: %s.\n', $stmt->error);
                return false;
            }
            
        }

        public function update() {

            $query = 'UPDATE ' . $this->table . ' SET comment = :comment WHERE id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->comment = htmlspecialchars(strip_tags($this->comment));

            if ($stmt->execute(['id' => $this->id, 'comment' => $this->comment])) {

                return true;
            } else {

                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }

        public function delete() {

            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            $stmt = $this->conn->prepare($query);
            if ($stmt->execute(['id' => $this->id])) {

                return true;
            } else {

                print('Error: %s.\n'. $stmt->error);
                return false;
            }
        }
    }
?>