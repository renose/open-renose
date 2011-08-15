<?php

/*
 * display.ctp
 * 
 * Copyright (c) 2011 open reNose team <info at renose.de>.
 * Simon Wörner and Patrick Hafner.
 * 
 * This file is part of open reNose.
 * 
 * open reNose is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * open reNose is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with open reNose.  If not, see <http ://www.gnu.org/licenses/>.
 */
?>
<?php
    $html->addCrumb('Berichte', 'display');
?>

<h1><?php echo $title_for_layout; ?></h1>

<h1>
    <center><?php echo $year; ?></center>
</h1>

<?php    
    foreach($reports as $report)
            $week_reports[$report['Report']['week']] = $report;
    
    function mkdate($day, $month, $year)
    {
        return mktime(0,0,0, $month, $day, $year);
    }
    
    //Alle Monate durchlaufen
    for($month = 1; $month <= 12; $month++) {
?>
<table>
    <caption>
        <b><?php echo date('F', mkdate(1, $month, $year)); ?></b>
    </caption>
    
    <tbody>
        <tr>
            <th title="Wochennummer">Nr.</th>
            <th title="Montag">Mo</th>
            <th title="Dienstag">Di</th>
            <th title="Mittwoch">Mi</th>
            <th title="Donnerstag">Do</th>
            <th title="Freitag">Fr</th>
            <th title="Samstag">Sa</th>
            <th title="Sonntag">So</th>
        </tr>
        
        <tr></tr>
        
        <?php
            //Alle Tage des Monats durchlaufen
            for($day = 1; $day <= date('t', mkdate(1, $month, $year)); $day++)
            {
                //Woche ermitteln
                $week = date('W', mkdate($day, $month, $year));
                
                //Neue Woche am Montag anfangen (und am 1. des Monats) und Wochennummer anzeigen
                if(date('N', mkdate($day, $month, $year)) == 1 || $day == 1)
                {
                    echo "<tr>";
                    
                    //Erste Woche die noch zum letzten Jahr gehört
                    if($day == 1 && $month == 1 && $week > 1)
                        $year_link = $year - 1;
                    else
                        $year_link = $year;
                    
                    if(isset($week_reports[$week]))
                        echo "<td class='calendar-week-view' title='Woche $week'>" . $html->link($week, array('action' => 'view', $year_link, $week)) . "</td>";
                    else
                        echo "<td class='calendar-week-add' title='Woche $week'>" . $html->link($week, array('action' => 'add', $year_link, $week)) . "</td>";
                    
                    //Wenn erster Tag KEIN Montag ist Leertage einfügen
                    if($day == 1 && date('w', mkdate($day, $month, $year)) > 1)
                        echo "<td colspan='" . (date('w', mkdate($day, $month, $year)) - 1) . "'></td>";
                }
                
                //Tag anzeigen
                echo "<td>$day</td>";
                
                //Woche nach Sonntag beenden
                if(date('N', mkdate($day, $month, $year)) == 7)
                    echo "</tr>";
            }
        ?>
        </tr>
    </tbody>
</table>
<?php } //Ende der Monatsschleife ?>

<br/>

<?php pr($reports); ?>