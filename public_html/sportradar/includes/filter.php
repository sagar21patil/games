<?php
require_once("./api/config/database.php");
require_once('reusefunctions.php');

class Filter extends ResuseFunctions
{
  public $conn;

    public function __construct(){
      // instantiate database
      $database = new Database();
      $this->conn = $database->getConnection();
    }

    public function getAllSportList()
    {
      try{
            $sportList=array();
            $query="SELECT sport_id, sport_name
                          FROM sports
                          WHERE status='active'
                          ORDER BY sport_name ASC";

            $result = mysqli_query($this->conn,$query);
            while ($row = $result->fetch_assoc()){
              $sportList[]=$row;
            }
            //echo "sagar<pre>";print_r($sportList,0);die;
            return $sportList;
          }catch (Exception $e) {
          // Error Exception print
            echo  'Caught exception: '. $e->getMessage();
          }
    }

    public function getALLTeamsList()
    {
      try{
            $teamsList=array();
            $query="SELECT team.team_id, team.team_name
                          FROM teams as team
                          INNER JOIN leagues as league ON league.league_id=team._league_id
                          INNER JOIN sports as sport ON sport.sport_id=league._sport_id
                          WHERE sport.status='active' AND league.league_status='active' AND team.team_status='active'
                          ORDER BY team.team_name ASC";

            $result = mysqli_query($this->conn,$query);
            while ($row = $result->fetch_assoc()){
              $teamsList[]=$row;
            }
            return $teamsList;
          }catch (Exception $e) {
            // Error Exception print
            echo  'Caught exception: '. $e->getMessage();
          }
        //echo "sagar<pre>";print_r($sportList,0);die;
    }
    public function getLocationsList()
    {
      try{
            $locationList=array();
            $query="SELECT location_id, concat(IFNULL(city,''),', ',IFNULL(country,'')) as location_name
                          FROM locations
                          WHERE location_status='active'
                          ORDER BY city ASC";

            $result = mysqli_query($this->conn,$query);
            while ($row = $result->fetch_assoc()){
              $locationList[]=$row;
            }
            //echo "sagar<pre>";print_r($sportList,0);die;
            return $locationList;
          }catch (Exception $e) {
          // Error Exception print
            echo  'Caught exception: '. $e->getMessage();
          }
    }
    public function getFilterFieldsValues()
    {
      $filterValues['sports']=$this->getAllSportList();
      $filterValues['teams']=$this->getALLTeamsList();
      $filterValues['locations']=$this->getLocationsList();
      $filterValues['leagues']=$this->getLeaguesList();
      return $filterValues;
    }
    public function getLeaguesList()
    {
      try{
            $leaguesList=array();
            $query="SELECT league_id, league_short_name,league_full_name
                          FROM leagues
                          INNER JOIN sports as sport ON sport.sport_id=leagues._sport_id
                          WHERE league_status='active' AND sport.status='active'
                          ORDER BY league_short_name ASC";

            $result = mysqli_query($this->conn,$query);
            while ($row = $result->fetch_assoc()){
              $leaguesList[]=$row;
            }
            //echo "sagar<pre>";print_r($sportList,0);die;
            return $leaguesList;
          }catch (Exception $e) {
          // Error Exception print
            echo  'Caught exception: '. $e->getMessage();
          }
    }
    public function getEventList()
    {
        $return_message['login_success'] = false;
        $return_message['error'] = '';
        $return_message['is_error'] = 0;
        $is_validation_error='';
        //Server side validation
        if(empty($this->_request['user_name']) && empty($this->_request['password'])){
            $return_message['is_error'] = 1;
            return $return_message['error'] = 'Please enter login credentials.';
        }
        else if(empty($this->_request['user_name']))
        {
            $return_message['is_error'] = 1;
            return $return_message['error'] = 'Please enter a Username.';
        }else if(empty($this->_request['password'])){
            $return_message['is_error'] = 1;
            return $return_message['error'] = 'Please enter password.';
        }

        try{

      				// instantiate database
      				$database = new Database();
      				$this->conn = $database->getConnection();

      			  $query = "SELECT user_id,user_name,status,user_type
      				FROM users WHERE user_name='".$this->_request['user_name']."' AND password='".sha1($this->_request['password'])."' AND status=0 LIMIT 0,1";
      				// prepare query statement
      		    $result = $this->conn->query($query);

      		    // execute query
      				$resultArray=array();

      				while ($row = mysqli_fetch_assoc($result)){
      					$resultArray=$row;
      				}

              if(!empty($resultArray)){
                      //Set loggedin user's session
                      $_SESSION['userID'] = $resultArray['user_id'];
                      $_SESSION['alogin'] = ucfirst($resultArray['user_name']);
                      $_SESSION['status'] = $resultArray['status'];
                      $_SESSION['is_admin'] = $resultArray['user_type']; //Admin=1, Normal User=0
                      $return_message['is_error'] = 0;
                      $return_message['login_success'] = true;
                      $return_message['redirection_file'] = 'graph.php';
              }else{
                  $return_message['is_error'] = 1;
                  $_SESSION['error'] = 'Invalid login credentials.';
              }
        }catch(Exception $e)
        {
          $return_message['is_error'] = 1;
          $_SESSION['error'] = 'Caught exception: '. $e->getMessage();
        }

        return $return_message;
    }


}
?>
