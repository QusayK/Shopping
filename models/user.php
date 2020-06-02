<?php
    class User {

        private $conn;
        private $table;

        public $id;
        public $name;
        public $email;
        public $password;

        public function __construct($db) {

            $this->conn = $db;
        }

        public function read_single() {

            $query = 'SELECT * FROM users WHERE id = :id';

            $stmt =  $this->conn->prepare($query);
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->execute(['id' => $this->id]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            extract($row);

            $this->id = htmlspecialchars(strip_tags($id));
            $this->name = htmlspecialchars(strip_tags($name));
            $this->email = htmlspecialchars(strip_tags($email));
            $this->password = htmlspecialchars(strip_tags($password));
        }

        public function create() {

            $query = 'INSERT INTO users (name, email, password)
            VALUES (:name, :email, :password)';

            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            if ($stmt->execute(['name' => $this->name, 'email' => $this->email, 'password' => $this->password])) {

                return true;
            } else {

                return false;
            }
        }
    }
?>