<?php
  class Candidats {
    // DB Stuff
    private $conn;
    private $table = 'candidats';

    // Properties
    public $id;
    public $name;
    public $firstname;
    public $party;
    public $nb_vote;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get candidats
    public function read() {
      // Create query
      $query = 'SELECT
        id,
        name,
        firstname,
        party,
        nb_vote
      FROM
        ' . $this->table .'';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single candidats
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

  // Create candidats
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      name = :name,
      firstname = :firstname,
      party = :party';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->firstname = htmlspecialchars(strip_tags($this->firstname));
  $this->party = htmlspecialchars(strip_tags($this->party));

  // Bind data
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':firstname', $this->firstname);
  $stmt-> bindParam(':party', $this->party);
  

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update candidats
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      name = :name,
      firstname = :firstname
      WHERE
      id = :id';

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

  // add a vote 
  public function voter(){
    //creat query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      nb_vote = nb_vote + 1
      WHERE
      id = :id';
  
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

  //get te big rkhiss
public function getTheBigRkhiss(){
  // Create query
  $query = 'SELECT
  id,
  name,
  firstname,
  party,
  MAX(nb_vote) AS nb_vote
FROM
  ' . $this->table .'';

// Prepare statement
$stmt = $this->conn->prepare($query);

// Execute query
$stmt->execute();

return $stmt;

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
