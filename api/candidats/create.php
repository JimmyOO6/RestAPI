<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Candidats.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $candidats = new Candidats($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $candidats->name = $data->name;
  $candidats->firstname = $data->firstname;
  $candidats->party = $data->party;


  // Create Candidats
  if($candidats->create()) {
    echo json_encode(
      array('message' => 'Candidats Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Candidats Not Created')
    );
  }
