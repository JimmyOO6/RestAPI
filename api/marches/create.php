<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Marches.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $marches = new Marches($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $marches->lieuF = $data->lieuF;
  $marches->lieuT = $data->lieuT;
  $marches->date = $data->date;


  // Create Candidats
  if($marches->create()) {
    echo json_encode(
      array('message' => 'Marche Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Marche Not Created')
    );
  }
