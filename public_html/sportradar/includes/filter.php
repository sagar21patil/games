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


    public function getFilterFieldsValues()
    {
      //To fetch all active sport list
      $sportsQuery="SELECT sport_id as id, sport_name as name
                    FROM sports
                    WHERE status='active'
                    ORDER BY sport_name ASC";
      //To fetch all active Leagues list
      $leaguesQuery="SELECT league_id, league_short_name,league_full_name
                    FROM leagues INNER JOIN sports as sport ON sport.sport_id=leagues._sport_id
                    WHERE league_status='active' AND sport.status='active'
                    ORDER BY league_short_name ASC";
      //To fetch all active teams list
      $teamsQuery="SELECT team.team_id as id, team.team_name as name
                    FROM teams as team
                    INNER JOIN leagues as league ON league.league_id=team._league_id
                    INNER JOIN sports as sport ON sport.sport_id=league._sport_id
                    WHERE sport.status='active' AND league.league_status='active' AND team.team_status='active'
                    ORDER BY team.team_name ASC";
      //To fetch all active locations list
      $locationsQuery="SELECT location_id as id, concat(IFNULL(city,''),', ',IFNULL(country,'')) as name
                     FROM locations
                     WHERE location_status='active'
                     ORDER BY city ASC";

      $filterValues['sportsInput']=$this->getHTMLDropDown("_sport_id","--Sport--",$sportsQuery);
      $filterValues['teamsInput']=$this->getHTMLDropDown("_team_ida","--Team--",$teamsQuery)."&nbsp;vs".$this->getHTMLDropDown("_team_idb","--Team--",$teamsQuery);
      $filterValues['locationsInput']=$this->getHTMLDropDown("_location_id","--Location--",$locationsQuery);

      //righthand side panel values to main page
      $filterValues['leagues']=$this->getRowQueryResults($leaguesQuery);
      $filterValues['sports']=$this->getRowQueryResults($sportsQuery);

      //retun dropdowns and righthand side panel values to main page
      return $filterValues;
    }

    //Get all record(s) list by passing custom query
    public function getRowQueryResults($query)
    {
      try{
            $dropdownList=array();
            $result = mysqli_query($this->conn,$query);
            while ($row = $result->fetch_assoc()){
              $dropdownList[]=$row;
            }
              return $dropdownList;
          }catch (Exception $e) {
          // Error Exception print
            echo  'Caught exception: '. $e->getMessage();
          }
    }
    //get generated HTML dropdownList with dynamic values by passing query
    public function getHTMLDropDown($inputName,$emptyOption,$query)
    {
      try{
        $result = mysqli_query($this->conn,$query);
        $html="&nbsp;<select name='".$inputName."' id='".$inputName."'><option value=''>".$emptyOption."</option>";
        $options="";
        while ($row = $result->fetch_assoc()){
          $options.="<option value=".$row['id'].">".$row['name']."</option>";
        }
          return $html.$options."</select>";
        }catch (Exception $e) {
        // Error Exception print
          echo  'Caught exception: '. $e->getMessage();
        }
    }
}
?>
