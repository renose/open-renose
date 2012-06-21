<?= $this->Html->css($this->Html->url($templatePath.'css/ihk.css', true)); ?>
<table border="1" class="activityList">
    <tr>
        <td colspan="4" align="center"><h1 style="line-height:6px; font-size: 16pt;">Ausbildungsgang</h1></td>
    </tr>

    <tr>
        <td rowspan="2" align="center" width="40%" class="no-lineheight">Abteilung<br>(Arbeitsgebiet oder Sparte)</td>
        <td colspan="2" align="center" width="35%">Dauer</td>
        <td rowspan="2" align="center" width="25%" class="no-lineheight">Unterschrift des Abteilungsleiters oder des Ausbildenden</td>
    </tr>

    <tr>

        <td align="center">vom</td>
        <td align="center">bis</td>
    </tr>

    <?php

    for($i=$start;$i<$end;$i++) {
        if(!(isset($reports[$i]))) break;
    ?>

        <tr nobr="true">
            <td><?= $reports[$i]['Report']['department'] ?></td>
            <td align="center"><?= $this->reNoseDate->getMondayByYearAndWeek($reports[$i]['Report']['year'], $reports[$i]['Report']['week'], $user['Profile']['start_training_period']); ?></td>
            <td align="center"><?= $this->reNoseDate->getFridayByYearAndWeek($reports[$i]['Report']['year'], $reports[$i]['Report']['week'], $user['Profile']['end_training_period']); ?></td>
            <td></td>
        </tr>
        <?php
    }
    ?>
</table>