<?php
  class Marches {
    private $conn;
    private $table = 'marches';


    public $id;
    public $lieuF;
    public $lieuT;
    public $date;


    public function __construct($db) {
      $this->conn = $db;
    }


    public function read() {
      // Create query
      $query = 'SELECT
        id,
        lieuF,
        lieuT,
        date
      FROM
        ' . $this->table .'';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }


  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      lieuF = :lieuF,
      lieuT = :lieuT,
      date = :date';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->lieuF = htmlspecialchars(strip_tags($this->lieuF));
  $this->lieuT = htmlspecialchars(strip_tags($this->lieuT));
  $this->date = htmlspecialchars(strip_tags($this->date));

  $stmt-> bindParam(':lieuF', $this->lieuF);
  $stmt-> bindParam(':lieuT', $this->lieuT);
  $stmt-> bindParam(':date', $this->date);

  

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
      lieuF = :lieuT,
      lieuT= :lieuT,
      date= :date,
      WHERE
      id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->lieuF = htmlspecialchars(strip_tags($this->lieuF));
    $this->lieuT = htmlspecialchars(strip_tags($this->lieuT));
    $this->date = htmlspecialchars(strip_tags($this->date));
    
    

    // Bind data
    $stmt-> bindParam(':id', $this->id);
    $stmt-> bindParam(':lieuF', $this->lieuF);
    $stmt-> bindParam(':lieuT', $this->lieuT);
    $stmt-> bindParam(':date', $this->date);
    

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
