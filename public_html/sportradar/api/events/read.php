<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/events.php';
require_once('../../includes/reusefunctions.php');

//echo "<pre>";print_r($_POST,0);die;
try {
      // instantiate database and event object
      $database = new Database();
      $db = $database->getConnection();

      // filter/clean input(s)
      $cleanInput= new ResuseFunctions();

      // initialize event class object
      $eventObj = new Events($db);

      //check API parameters validatin
      if(!$eventObj->parametersCheck($cleanInput->_request))
      {
        // set response code
        http_response_code(400);

        // tell the user this bad request
        echo json_encode(
            array("message" => "Invalid API parameters")
        );
        exit;
      }

      // prin event(s) calendar
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
