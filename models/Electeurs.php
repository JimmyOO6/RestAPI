<?php
  class Electeurs {
    private $conn;
    private $table = 'electeurs';
    private $table_condidat= 'condidats';

    public $id;
    public $name;
    public $firstname;
    public $idC;
    


    public function __construct($db) {
      $this->conn = $db;
    }


    public function read() {
      // Create query
      $query = 'SELECT
        id,
        name,
        firstname
      FROM
        ' . $this->table .'';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  public function read_single(){
    // Create query
    $query = 'SELECT
          id,
          name
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->name = $row['name'];
  }

  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      name = :name,
      firstname = :firstname';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->firstname = htmlspecialchars(strip_tags($this->firstname));

  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':firstname', $this->firstname);

  

  if($stmt->execute()) {
    return true;
  }


  printf("Error: $s.\n", $stmt->error);

  return false;
  }


  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      name = :name,
      firstname = :firstname
      WHERE
      idC = : idC';

  
      // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->id = htmlspecialchars(strip_tags($this->id));
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->firstname = htmlspecialchars(strip_tags($this->firstname));
  
    

  // Bind data
  $stmt-> bindParam(':id', $this->id);
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':firstname', $this->firstname);
  

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete candidats
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  
  

  

}