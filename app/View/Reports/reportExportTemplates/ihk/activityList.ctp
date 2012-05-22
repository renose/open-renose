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
        if(!(isset($activityList[$i]))) break;;
    ?>

        <tr nobr="true">
            <td><?= $activityList[$i]['abteilung'] ?></td>
            <td align="center"><?= $activityList[$i]['von'] ?></td>
            <td align="center"><?= $activityList[$i]['bis'] ?></td>
            <td></td>
        </tr>
        <?php
    }
    ?>
</table>