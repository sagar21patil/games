<?php
require_once('includes/filter.php');
require_once('api/objects/events.php');
require_once("./api/config/database.php");

$database = new Database();
$filterObj=new Filter();
$filterValues=$filterObj->getFilterFieldsValues();
$eventObj=new Events($database->getConnection());
//echo "<pre>";print_r($filterValues,0);die;
 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en" dir="ltr">
<head>
<link href="css/style.css" rel="stylesheet" />

</head>
<body>
<div id="header"> <!--<a href="https://www.sportradar.com/" target="_blank">-->
  <img src="images/header.png" alt="Topend Sports, science, training and nutrition " style="height:295px"></div>
<!-- #EndLibraryItem --><div id="container">
  <div id="content"> 

<h1>2020  World Sporting Event Calendar</h1>
<p>Here is a list of the major sporting events for the year 2019. Not every sporting event can be listed here, though we have tried to include all the <strong>significant sporting events</strong> of the <strong>major sports</strong>, mostly the <strong>international competitions</strong>.</p>
<form id="sportfilter" name="sportfilter" method="post">
  <select name="_sport_id" id="_sport_id">
    <option value="">Sport</option>
    <?php
      if(!empty($filterValues['sports']))
      {
        foreach($filterValues['sports'] as $sport)
        {
          echo "<option value=".$sport['sport_id'].">".$sport['sport_name']."</option>";
        }
      }
    ?>
  </select>
<select name="_team_ida" id="_team_ida">
  <option value="">Team A</option>
  <?php
    if(!empty($filterValues['teams']))
    {
      foreach($filterValues['teams'] as $team)
      {
        echo "<option value=".$team['team_id'].">".$team['team_name']."</option>";
      }
    }
  ?>
</select>&nbsp;vs&nbsp;
<select name="_team_idb" id="_team_idb">
  <option value=""> Team B</option>
  <?php
    if(!empty($filterValues['teams']))
    {
      foreach($filterValues['teams'] as $team)
      {
        echo "<option value=".$team['team_id'].">".$team['team_name']."</option>";
      }
    }
  ?>
</select>
<select name="_location_id" id="_location_id">
  <option value=""> Location</option>
  <?php
    if(!empty($filterValues['locations']))
    {
      foreach($filterValues['locations'] as $location)
      {
        echo "<option value=".$location['location_id'].">".$location['location_name']."</option>";
      }
    }
  ?>
</select>
<div class="clearfix"><br/></div>
<select name="event_status" id="event_status">
  <option value=""> Game Status</option>
  <option value="Abandoned">Abandoned</option>
  <option value="Cancelled">Cancelled</option>
  <option value="Delayed">Delayed </option>
  <option value="Ended"> Ended</option>
  <option value="Finished">Finished</option>
  <option value="Interrupted">Interrupted</option>
  <option value="Live">Live</option>
  <option value="NotStarted">NotStarted</option>
  <option value="Postponed">Postponed</option>
  <option value="Suspended">Suspended</option>
</select>
<div class="buttons">
<button class="btn btn-primary" name="Reset" id="Reset" type="reset" > Reset</button>&nbsp;&nbsp;
<button class="btn btn-primary" name="submit" id="submit" type="submit" > Submit</button>&nbsp;&nbsp;
</div>
</form>
<div class="clearfix"></div>
    <div class="table-responsive">
<?php  echo json_decode($eventObj->eventLists()); ?>
</div>

</div>

<div id="grouping" >

<div id="search">
<img src="images/inner.jpg">
</div>
<div class="extra">
  <h3>Specific Sports</h3>
  <ul>
    <?php
      if(!empty($filterValues['sports']))
      {
        foreach($filterValues['sports'] as $sport)
        {
          echo "<li>".$sport['sport_name']."</li>";
        }
      }
    ?>
  </ul>

  <h3>Leagues</h3>
  <ul>
    <?php
      if(!empty($filterValues['leagues']))
      {
        foreach($filterValues['leagues'] as $league)
        {
          echo "<li>".$league['league_short_name']."&nbsp;(".$league['league_full_name'].")</li>";
        }
      }
    ?>
  </ul>
</div>
</div>
<div class="clearfix"></div>
</div>
<div id="citation">

</div>
<div id="footer-ad" align="center">

</div>
	<script src="js/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body></html>
