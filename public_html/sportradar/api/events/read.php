<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/events.php';
require_once('../../includes/reusefunctions.php');

// instantiate database and event object
try {

  //echo "<pre>";print_r($_POST,0),die;

      $database = new Database();
      $db = $database->getConnection();

      // filter input
      $cleanInput= new ResuseFunctions();

      // initialize object
      $eventObj = new Events($db);
      //Accept parametersCheck validatin
      if(!$eventObj->parametersCheck($cleanInput->_request))
      {
        // set response code
        http_response_code(200);

        // tell the user no sessions found
        echo json_encode(
            array("message" => "Invalid API parameters")
        );
        exit;
      }

      // query events
      echo $eventObj->eventLists($cleanInput->_request);
      exit;

} catch (Exception $e) {

  http_response_code(404);

  // Error Exception print
  echo json_encode(
      array("statusText" =>  'Caught exception: '. $e->getMessage())
  );
  exit;
}
