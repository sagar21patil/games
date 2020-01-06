<?php
$teams = array(
    'Team 1',
    'Team 2',
    'Team 3',
    'Team 4',
    'Team 5',
    'Team 6',
    'Team 7',
    'Team 8'
);

function getMatches($teams) {
    shuffle($teams);
    return call_user_func_array('array_combine', array_chunk($teams, sizeof($teams) / 2));
}

for ($i = 0; $i < 14; $i += 1) {
  echo "<pre>";  print_r(getMatches($teams));
}
?>
