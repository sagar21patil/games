<?php
class Events
{
    // database connection and table name
    private $conn;
    private $table_name = "events";

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read sessions
    public function read($searchParams){
      $whereCondition=array();
      $timeClause="";
      if(!empty($searchParams)){
          foreach($searchParams as $k=>$v)
          {
            if($v<>'')
            {
              //Generate where condition from user selected fields from filter
              if($k=='start_date'){
                $date="'".str_replace(' - ',"' AND '",$v)."'";
                $whereCondition[]="(DATE_FORMAT(start_time,'%m/%d/%Y') BETWEEN ".$date.")";
              }else{
                $whereCondition[]="".$k."='".$v."'";
              }
            }


          }
          //If user select other fields except game status field then show present and feature games only
          if(!$searchParams['event_status']<>'' && $searchParams['start_date']=='')
            {
              $timeClause=" AND end_time>=now() ";
            }
          $extraConditions=$timeClause." AND ".implode(" AND ",$whereCondition);
        }else{

          //first page load show present and feature games only (Without filter)
          $extraConditions=" AND end_time>=now() ";;
        }

        //This is simple query to show event(s) calendar to user
          $searchQuery="SELECT sport.sport_name,start_time,event_status,concat(IFNULL(team.team_name,''),' - ',IFNULL(team1.team_name,'')) as game_between_teams, concat(IFNULL(location.city,''),', ',IFNULL(location.country,'')) as location_name
					          FROM events
                    INNER JOIN sports as sport ON sport.sport_id=events._sport_id
                    INNER JOIN teams as team ON team.team_id=events._team_ida
                    INNER JOIN teams as team1 ON team1.team_id=events._team_idb
                    INNER JOIN locations as location ON events._location_id=location.location_id
                    WHERE sport.status='active' AND location.location_status='active'
                    ".$extraConditions." ORDER by start_time ASC,
                    CASE event_status WHEN 'Live' THEN 1 WHEN 'NotStarted' THEN 2  WHEN 'Delayed' THEN 3  WHEN 'Postponed' THEN 4
                    WHEN 'Interrupted' THEN 5 WHEN 'Finished' THEN 6 WHEN 'Ended' THEN 7 WHEN 'Cancelled' THEN 8 WHEN 'Suspended' THEN 9
                    WHEN 'Abandoned' THEN 10 END ASC";

      $result = mysqli_query($this->conn,$searchQuery);
      return $result;
    }

    //To get eventlist to show as filter result
    public function eventLists($searchParams=null)
    {
      // query events
      $eventResults= $this->read($searchParams);
      $num = mysqli_num_rows($eventResults);

      // check if more than 0 record found
      if($num>0){
          // set response code - 200 OK
          http_response_code(200);

          // show event(s) data
          return json_encode($this->buildHTMLTable($eventResults));
      }else{

          // set response code - 404 Not found
          http_response_code(200);

          // tell the user no event(s) found
          return json_encode($this->buildHTMLTable(""));
      }
    }

   //To build HTML sport event Calendar
   public function buildHTMLTable($result)
    {
      $htmlTable="<table class='list'><tr><th>Date(s)</th><th>Sport</th><th>Teams</th><th>Location</th><th>Status</th></tr>";
      if(!empty($result))
      {
          $rowtr="";
          while($row = $result->fetch_assoc()) {
              $rowtr.="<tr><td>".date('D, d.m.Y, H:i', strtotime($row['start_time']))."</td><td>".$row['sport_name']."</td><td>".$row['game_between_teams']."</td><td>".$row['location_name']."</td><td>".$row['event_status']."</td></tr>";
          }

           $result -> free_result();
           $htmlTable.=$rowtr."</table>";
      }else{
          $htmlTable.="<tr><td colspan=4 style='color:red'>No event(s) found.</td></tr></table>";
      }
      return $htmlTable;
    }

    //To check API parameters are correct or not
    public function parametersCheck($parameters){
      $valid_parameters=array('_sport_id','_team_ida','_team_idb','_location_id','event_status','start_date');
      $api_parameters=@array_keys($parameters);
      $parametersCount=count(@array_diff($valid_parameters,$api_parameters));

        if(count($api_parameters)>6 || $_SERVER['REQUEST_METHOD']!='POST' || $parametersCount>=1)
        {
          return false;
        }
        return true;
    }

}
?>
