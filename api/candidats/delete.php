<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Candidats.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $candidats = new Candidats ($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $candidats->id = $data->id;

  // Delete post
  if($candidats->delete()) {
    echo json_encode(
      array('message' => 'Candidats deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Candidats  not deleted')
    );
  }
