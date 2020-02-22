<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Electeurs.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $electeurs = new Electeurs($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $electeurs->name = $data->name;
  $electeurs->firstname = $data->firstname;
  


  // Create Electeurs
  if($electeurs->create()) {
    echo json_encode(
      array('message' => 'Electeurs Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Electeurs Not Created')
    );
  }
