<?php

$starttime="09:00 AM";
echo $starttime;
echo '<br>*****************<br>';
$add_starttime=date("H:i:s", strtotime($starttime));
echo $add_starttime;
echo '<br>*****************<br>';
$n_starttime=date("h:i A", strtotime("90 minutes", strtotime($add_starttime)));
echo $n_starttime;
echo '<br>*****************<br>';
$nn_starttime=date("h:i A", strtotime("-90 minutes", strtotime($add_starttime)));
echo $nn_starttime;
echo '<br>*****************<br>';


?>