<?php
    class Category {
        // DB stuff
        private $conn;
        private $table = 'categories';

        // Categories Properties
        public $id;
        public $name;
        public $created_at;

       // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Categories

        public function read(){
            // Create Query
            $query = 'SELECT
                      id,
                      name
                      FROM '. $this->table .'
                      ORDER BY 
                      id DESC';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execurte query
            $stmt->execute();
            return $stmt;
        }

        // Get single category by id

        public function read_single() {
            // Create Query
            $query = 'SELECT
                        name
                      FROM '. $this->table .'
                      WHERE
                        id = ?
                      LIMIT 0,1';

           // Prepare statement
           $stmt = $this->conn->prepare($query);

           // Bind id
           $stmt->bindParam(1, $this->id);

           // Execute query
           $stmt->execute();

           $row = $stmt->fetch(PDO::FETCH_ASSOC);

           // Set properties
           $this->name = $row['name'];

        }

        // Create Categories
        public function create(){
             // Create Query
             $query = 'INSERT INTO '. $this->table .'
             SET
               name = :name ';

            // Prepare statment
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));

            // Bind Data
            $stmt->bindParam(':name', $this->name);

             // Execurte query
            if($stmt->execute()){
                return true;
            }

            // Print error if something  goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;


        }

        public function update(){
             // Create Query
             $query = 'UPDATE '. $this->table .'
             SET
               name = :name
            WHERE
                id = :id ';

            // Prepare statment
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':id', $this->id);

             // Execurte query
            if($stmt->execute()){
                return true;
            }

            // Print error if something  goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;

            
        }

        public function delete(){
            // Create query
            $query = 'DELETE FROM ' . $this->table .' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execurte query
            if($stmt->execute()){
                return true;
            }

            // Print error if something  goes wrong
            printf("Error: %s.\n", $stmt->error);


            return false;
            
        }

    }