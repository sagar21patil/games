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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
$(function() {

  $('input[name="start_date"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="start_date"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });
    });
</script>
</head>
<body>
<div id="header"> <!--<a href="https://www.sportradar.com/" target="_blank">-->
  <img src="images/header.png" alt="Topend Sports, science, training and nutrition " style="height:295px"></div>
<!-- #EndLibraryItem --><div id="container">
  <div id="content">

<h1>2020  World Sporting Event Calendar</h1>
<p>Here is a list of the major sporting events for the year 2019. Not every sporting event can be listed here, though we have tried to include all the <strong>significant sporting events</strong> of the <strong>major sports</strong>, mostly the <strong>international competitions</strong>.</p>
<form id="sportfilter" name="sportfilter" method="post">
  <?php
        echo $filterValues['sportsInput'];
        echo $filterValues['teamsInput'];
        echo $filterValues['locationsInput'];
  ?>

<div class="clearfix"><br/></div>
<select name="event_status" id="event_status">
  <option value="">--Game Status--</option>
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
<span style="font-family:Verdana, Geneva, sans-serif;font-size:0.9em;line-height:1.8em">Date:</span><input type="text" name="start_date"  value="" />
<div class="buttons">
<button class="btn btn-primary" name="Reset" id="Reset" type="reset" > Reset</button>&nbsp;
<button class="btn btn-primary" name="submit" id="submit" type="submit" > Submit</button>&nbsp;
</div>
</form>
<div class="clearfix"></div>
    <div class="table-responsive">
<?php
//Load default events on first time page load
echo json_decode($eventObj->eventLists()); ?>
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
          echo "<li>".$sport['name']."</li>";
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
  <script src="js/main.js"></script>
</body></html>
