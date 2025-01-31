<?php
    class User {

        private $conn;
        private $table = "users";

        public $id;
        public $name;
        public $email;
        public $password;

        public function __construct($db) {

            $this->conn = $db;
        }

        public function read_single() {

            $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

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

            $query = 'INSERT INTO ' . $this->table . ' (name, email, password)
            VALUES (:name, :email, :password)';

            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            if ($stmt->execute(['name' => $this->name, 'email' => $this->email, 'password' => $this->password])) {

                $sql = 'SELECT id FROM ' . $this->table . ' WHERE email = :email';
                $stm = $this->conn->prepare($sql);
                $stm->execute(['email' => $this->email]);

                $row = $stm->fetch(PDO::FETCH_ASSOC);
                $this->id = $row['id'];
                
                return true;
            } else {

                return false;
            }
        }

        public function check() {

            $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email AND password = :password';

            $stmt = $this->conn->prepare($query);

            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $stmt->execute(['email' => $this->email, 'password' => $this->password]);
            $num = $stmt->rowCount();

            if ($num > 0) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->id = $row['id'];

                return true;
            } else {

                return false;
            }
        }
    }
?>