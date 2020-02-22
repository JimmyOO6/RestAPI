<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to UPDATE
  $candidats->id = $data->id;
  

  // Update post
  if($candidats->voter()) {
    echo json_encode(
      array('message' => 'Candidats a recu un vote ')
    );
  } else {
    echo json_encode(
      array('message' => 'houston we have a probliiiiiiiiiiiiiiiiim')
    );
  }
