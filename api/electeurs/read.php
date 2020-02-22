<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Electeurs.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate candidats object
  $electeurs = new Electeurs($db);

  // Candidats  read query
  $result = $electeurs->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any candidats 
  if($num > 0) {
        // Cat array
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id,
            'name' => $name,
            'firstname' => $firstname
          );

          // Push to "data"
          array_push($cat_arr['data'], $cat_item);
        }

        // Turn to JSON & output
        echo json_encode($cat_arr);

  } else {
        // No Candidats 
        echo json_encode(
          array('message' => 'No Electeurs  Found')
        );
  }
