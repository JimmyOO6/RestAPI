<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to UPDATE
  $electeurs->id = $data->id;
  $electeurs->name = $data->name;
  $electeurs->firstname = $data->firstname;

  // Update post
  if($electeurs->update()) {
    echo json_encode(
      array('message' => 'Electeurs Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Electeurs not updated')
    );
  }
