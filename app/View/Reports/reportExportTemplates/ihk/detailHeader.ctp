<?= $this->Html->css($this->Html->url($templatePath.'css/ihk.css', true)); ?>
<table class="detailTable">
    <tr>
        <td><strong>Ausbildungsnachweis Nr. <?= $report['number'] ?></strong></td>
        <td>für die Zeit vom <?= $this->reNoseDate->getMondayByYearAndWeek($report['year'], $report['week'], $user['Profile']['start_training_period']); ?></td>
        <td>bis <?= $this->reNoseDate->getFridayByYearAndWeek($report['year'], $report['week'], $user['Profile']['end_training_period']); ?></td>
    </tr>
    <tr>
        <td colspan="2">Abteilung oder Arbeitsgebiet: <?= $report['department'] ?></td>
        <td>Datum: <?= $this->Time->format('d.m.Y', $report['date']); ?></td>
    </tr>
</table>