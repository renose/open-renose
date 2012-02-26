<?php
// Zeitstart
    function renderTime (){
        $time = explode( " ", microtime());
        $msec = (double)$time[0];
        $sec = (double)$time[1];

        return $sec + $msec;
    }
?>
