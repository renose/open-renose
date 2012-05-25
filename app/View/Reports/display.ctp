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
$this->Html->addCrumb('Berichte', 'display');
$this->Html->addCrumb($year, array('action' => 'display', $year));
?>

<h1>
    <?php echo $this->Html->image('icons/planner.png'); ?>
    <?php echo $title_for_layout; ?>
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
    foreach ($reports as $report)
        $week_reports[$report['Report']['week']] = $report;

    function mkdate($day, $month, $year)
    {
        return mktime(0, 0, 0, $month, $day, $year);
    }

    //Alle Monate durchlaufen
    for ($month = 1; $month <= 12; $month++): ?>
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

                        //Neue Woche am Montag anfangen (und am 1. des Monats) und Wochennummer anzeigen
                        if (date('N', mkdate($day, $month, $year)) == 1 || $day == 1)
                        {
                            echo "<tr>";

                            //Erste Woche die noch zum letzten Jahr gehört
                            if ($day == 1 && $month == 1 && $week > 1)
                                $year_link = $year - 1;
                            else
                                $year_link = $year;

                            if (isset($week_reports[$week]))
                            {
                                if (count($week_reports[$week]['ReportActivity']) > 0 && count($week_reports[$week]['ReportInstruction']) > 0)
                                    echo "<td class='calendar-week calendar-week-view-full' title='Woche $week'>" . $this->Html->link($week, array('action' => 'view', $year_link, $week)) . "</td>";
                                else
                                    echo "<td class='calendar-week calendar-week-view' title='Woche $week'>" . $this->Html->link($week, array('action' => 'view', $year_link, $week)) . "</td>";
                            }
                            else
                                echo "<td class='calendar-week calendar-week-add' title='Woche $week'>" . $this->Html->link($week, array('action' => 'add', $year_link, $week)) . "</td>";

                            //Wenn erster Tag KEIN Montag ist Leertage einfügen
                            if ($day == 1 && date('N', mkdate($day, $month, $year)) > 1)
                                echo "<td colspan='" . (date('N', mkdate($day, $month, $year)) - 1) . "'></td>";
                        }

                        $day_class = array('calendar-day');

                        //Aktueller Tag hervorheben
                        if (mkdate($day, $month, $year) == mkdate(date('d'), date('m'), date('Y')))
                            $day_class[] = 'calendar-day-today';
                        if(isset($calendar[date('Y-m-d', mkdate($day, $month, $year))]))
                        {
                            foreach($calendar[date('Y-m-d', mkdate($day, $month, $year))] as $event)
                            {
                                switch($event)
                                {
                                    case 1:
                                        $day_class[] = 'calendar-day-holiday';
                                        break;
                                    case 2:
                                        $day_class[] = 'calendar-day-vacation';
                                        break;
                                    case 3:
                                        $day_class[] = 'calendar-day-school-holidays';
                                        break;
                                }
                            }
                        }

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

<?php pr($reports); ?>

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
    $(document).ready(function(){ calendarResize(); });
</script>

<?php
    pr($calendar);
    pr($reports);
?>