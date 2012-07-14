<?php
$this->Html->addCrumb('Berichte');
$this->Html->addCrumb('Übersicht', array('action' => 'display', $year));
?>
<h1>
    <?php echo $this->Html->image('icons/calendar.png'); ?>
    Übersicht
</h1>

<div class="calendar-year">
    <div class="last">
        <?php echo $this->Html->link('≪ ' . ($year - 1), array($year - 1)); ?>
    </div>
    <div class="this">
        <h1><?php echo $year; ?></h1>
    </div>
    <div class="next">
        <?php echo $this->Html->link(($year + 1) . ' ≫', array($year + 1)); ?>
    </div>
</div>

<div class="calendar">
    <?php

    function mkdate($day, $month, $year)
    {
        return mktime(0, 0, 0, $month, $day, $year);
    }

    //Alle Monate durchlaufen
    for ($month = 1; $month <= 12; $month++):
        ?>
        <div class="calendar-month-container">
            <table class="calendar-month">
                <caption>
                    <b><?php echo __(date('F', mkdate(1, $month, $year))); ?></b>
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

                    <tr>

                        <?php
                        //Alle Tage des Monats durchlaufen
                        for ($day = 1; $day <= date('t', mkdate(1, $month, $year)); $day++)
                        {
                            //Woche ermitteln
                            $week = date('W', mkdate($day, $month, $year)) * 1;
                            $week_year = date('o', mkdate($day, $month, $year));

                            //Neue Woche am Montag anfangen (und am 1. des Monats) und Wochennummer anzeigen
                            if (date('N', mkdate($day, $month, $year)) == 1 || $day == 1)
                            {
                                echo "<tr>";

                                //Ampelsystem, wenn Report angelegt ist
                                if(isset($reports[$week_year][$week]['status']))
                                    $status = $reports[$week_year][$week]['status'];
                                else
                                    $status = null;
                                
                                if (isset($reports[$week_year][$week]['id']))
                                {
                                    if ($status == 'full')
                                        echo "<td class='calendar-week calendar-week-view-full calendar-week-nopadding'>" . $this->Html->link($week, array('controller' => $report_type, 'action' => 'view', $week_year, $week), array('class' => 'calendar-week-link', 'title' => 'Bericht '. $reports[$week_year][$week]['number'] .' bearbeiten')) . "</td>";
                                    else if ($status == 'half')
                                        echo "<td class='calendar-week calendar-week-view-half calendar-week-nopadding'>" . $this->Html->link($week, array('controller' => $report_type, 'action' => 'view', $week_year, $week), array('class' => 'calendar-week-link', 'title' => 'Bericht '. $reports[$week_year][$week]['number'] .' bearbeiten')) . "</td>";
                                    else
                                        echo "<td class='calendar-week calendar-week-view-empty calendar-week-nopadding'>" . $this->Html->link($week, array('controller' => $report_type, 'action' => 'view', $week_year, $week), array('class' => 'calendar-week-link', 'title' => 'Bericht '. $reports[$week_year][$week]['number'] .' bearbeiten')) . "</td>";
                                }
                                else if($status == 'missing')
                                    echo "<td class='calendar-week calendar-week-missing calendar-week-nopadding'>" . $this->Html->link($week, array('controller' => $report_type, 'action' => 'add', $week_year, $week), array('class' => 'calendar-week-link', 'title' => "Woche {$week} hinzufügen")) . "</td>";
                                else
                                    echo "<td class='calendar-week calendar-week-add calendar-week-nopadding'>" . $this->Html->link($week, array('controller' => $report_type, 'action' => 'add', $week_year, $week), array('class' => 'calendar-week-link', 'title' => "Woche {$week} hinzufügen")) . "</td>";

                                //Wenn erster Tag KEIN Montag ist Leertage einfügen
                                if ($day == 1 && date('N', mkdate($day, $month, $year)) > 1)
                                    echo "<td colspan='" . (date('N', mkdate($day, $month, $year)) - 1) . "'></td>";
                            }

                            $day_class = array('calendar-day');

                            //Aktueller Tag hervorheben
                            if (mkdate($day, $month, $year) == mkdate(date('d'), date('m'), date('Y')))
                                $day_class[] = 'calendar-day-today';

                            echo "<td class='" . implode(' ', $day_class) . "'>$day</td>";

                            //Woche nach Sonntag beenden
                            if (date('N', mkdate($day, $month, $year)) == 7)
                                echo "</tr>";
                        }

                        //Wenn letzter Tag KEIN Sonntag ist Leertage einfügen
                        if (date('N', mkdate($day - 1, $month, $year)) < 7)
                            echo "<td colspan='" . (7 - (date('N', mkdate($day - 1, $month, $year)))) . "'></td>";
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endfor; ?>
</div>

<div style="clear: both;"></div>

<script type="text/javascript">
    var resizeTimer;
    $(window).resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(calendarResize, 100);
    });

    function calendarResize() {
        var content_width = $('#content').width() - parseInt($('#content').css('padding-left'), 10) - parseInt($('#content').css('padding-right'), 10);
        var months_per_row = Math.floor(content_width / $('.calendar-month-container').outerWidth(true));
        months_per_row = months_per_row < 4 ? months_per_row : 4;
        var width = $('.calendar-month-container').outerWidth(true) * months_per_row;

        $('.calendar').css('width', width);
    }

    $(document).ready(function(){
        calendarResize();
    });
</script>

<?php
pr($report_type);
pr($reports);
pr($calendar);
?>