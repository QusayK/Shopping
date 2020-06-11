<?php
    class Product {

        private $conn;
        private $table = "products";

        public $id;
        public $type;
        public $price;
        public $image;
        public $uid;

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
            $this->image = $row['image'];
        }

        public function read_type() {

            $query = 'SELECT * FROM ' . $this->table . ' WHERE type = :type ORDER BY added_date DESC';

            $stmt = $this->conn->prepare($query);
            $this->type = htmlspecialchars(strip_tags($this->type));
            $stmt->execute(['type' => $this->type]);

            return $stmt;
        }

        public function read_type_favorite() {

            $query = 'SELECT * FROM ' . $this->table . ' AS  p, classification AS c WHERE p.id = c.id  AND c.uid = :uid AND type = :type AND favorite = 1 ORDER BY added_date DESC';

            $stmt = $this->conn->prepare($query);
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->uid = htmlspecialchars(strip_tags($this->uid));
            $stmt->execute(['uid' => $this->uid, 'type' => $this->type]);

            return $stmt;
        }

        public function read_type_basket() {

            $query = 'SELECT * FROM ' . $this->table . ' AS  p, classification AS c WHERE p.id = c.id AND c.uid = :uid AND type = :type AND basket = 1 ORDER BY added_date DESC';

            $stmt = $this->conn->prepare($query);
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->uid = htmlspecialchars(strip_tags($this->uid));
            $stmt->execute(['uid' => $this->uid, 'type' => $this->type]);

            return $stmt;
        }

        public function read_type_purchases() {

            $query = 'SELECT * FROM ' . $this->table . ' AS  p, classification AS c WHERE p.id = c.id  AND c.uid = :uid AND type = :type AND purchased = 1 ORDER BY added_date DESC';

            $stmt = $this->conn->prepare($query);
            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->uid = htmlspecialchars(strip_tags($this->uid));
            $stmt->execute(['uid' => $this->uid, 'type' => $this->type]);
            return $stmt;
        }

        public function read_favorite() {
            
            $query = 'SELECT * FROM ' . $this->table . ' AS p, classification AS c WHERE p.id = c.id AND c.uid = :uid AND favorite = 1 ORDER BY added_date DESC';

            $stmt = $this->conn->prepare($query);
            $this->uid = htmlspecialchars(strip_tags($this->uid));
            $stmt->execute(['uid' => $this->uid]);

            return $stmt;
        }

        public function read_basket() {

            $query = 'SELECT * FROM ' . $this->table . ' AS p, classification AS c WHERE p.id = c.id AND c.uid = :uid AND basket = 1 ORDER BY added_date DESC';

            $stmt = $this->conn->prepare($query);
            $this->uid = htmlspecialchars(strip_tags($this->uid));
            $stmt->execute(['uid' => $this->uid]);

            return $stmt;
        }

        public function read_purchases() {

            $query = 'SELECT * FROM ' . $this->table . ' AS p, classification AS c WHERE p.id = c.id AND c.uid = :uid AND purchased = 1 ORDER BY added_date DESC';

            $stmt = $this->conn->prepare($query);
            $this->uid = htmlspecialchars(strip_tags($this->uid));
            $stmt->execute(['uid' => $this->uid]);

            return $stmt;
        }

        public function create() {

            $query = 'INSERT INTO ' . $this->table . '(type, price, added_date, image)
            VALUES (:type, :price, NOW(), :image)';

            $stmt = $this->conn->prepare($query);

            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->image = htmlspecialchars(strip_tags($this->image));

            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':image', $this->image);

            if ($stmt->execute()) {

                return true;
            } else {

                printf('Error: %s.\n', $stmt->error);
                return false;
            }
        }

        public function update() {

            $query = 'UPDATE`' . $this->table . 
            '`SET `type` = :type, `price` = :price, `image` = :image WHERE `id` = :id';
            
            $stmt = $this->conn->prepare($query);

            $this->type = htmlspecialchars(strip_tags($this->type));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->image = htmlspecialchars(strip_tags($this->image));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':image', $this->image);
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