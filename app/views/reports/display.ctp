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

[<?php echo round($weeks / 7); ?> rows]
<br/>
(<?php echo round($weeks / 7); ?> * 88) + 44 =
<br/>
<?php echo (round($weeks / 7) * 88) + 44 ;?>px height

<h1>
    <center>Schuljahr <?php echo $year; ?> - <?php echo $year + 1; ?></center>
</h1>

<ol class="calendar" style="height: <?php echo (round($weeks / 7) * 88) + 44 ;?>px;">
    <ul>
        <?php
        
        //Reports in Array umschreiben
        foreach($reports as $report)
            $week_reports[$report['Report']['number']] = $report;
        
        //Datum test
        $start = $firstDay;
        
        for($i = 1; $i <= $weeks; $i++)
        {
            //array_key_exists($i, $week_reports);
            if(isset($week_reports[$i]))
            {
                echo str_replace('</a>', '', $html->link('', array('action' => 'view', $year, $i)));
                
                //TODO: -- check if done ---
                if(count($week_reports[$i]['ReportActivities']) + count($week_reports[$i]['ReportInstructions']) > 0 )
                    echo '<li class="done">';
                else
                    echo '<li>';
                
                //week number
                echo $i;
                
                //echo $week_reports[$i]['Report']['date'];
                echo '<p>';
                
                //week text
                echo $week_reports[$i]['Report']['date'] . '<br/>';
                echo 'Tätigkeiten: ' . count($week_reports[$i]['ReportActivities']) . '<br/>';
                echo 'Schulungen: ' . count($week_reports[$i]['ReportInstructions']) . '<br/>';
                //echo 'Status: Fertig';
                
                echo '</p>';
            }
            else
            {
                echo str_replace('</a>', '', $html->link('', array('action' => 'add', $year, $i)));
                echo '<li class="uncreated">';
                echo $i;
                
                /*echo '<p>';
                echo '<i>Status:</i> Nicht erstellt';
                echo '</p>';*/
            }
            
            echo '<p>';
            echo '<i>' . date('d.m.Y l', $start) . '</i> <br/>';
            echo '<i>' . date( 'd.m.Y l', $start + (5 - date('N', $start)) * (3600*24) ) . '</i>';
            echo '</p>';
            
            $start = $start + (8 - date('N', $start)) * (3600*24);
            
            echo '</li>';                
            echo '</a>';
        }
        
        ?>
        <?php /*
        <li class="inactive">1</li>
        <li>2</li>
        <a href="#"><li class="holiday">4 <p>You can use a paragraph element in here</p></li></a>
         */
        ?>
    </ul>
</ol>
<br/>

<?php pr($reports); ?>