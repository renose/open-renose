<?php
    $this->Html->addCrumb('Berichte');
    $this->Html->addCrumb('Übersicht', array('controller' => 'reports', 'action' => 'display', $report['Report']['year']));
    $this->Html->addCrumb('Bericht ' . $report['Report']['number']);
?>

<h1>
    <?php
        echo $this->Html->image('icons/clipboard.png');
        echo $title_for_layout;
    ?>
</h1>
<br/>

<div id="wysihtml5-toolbar" class="wysihtml5-toolbar" style="display: none;">
    <a data-wysihtml5-command="bold" title="Fett" class="wysihtml5-command" href="javascript:;">
        <?php echo $this->Html->image('icons/bold.png'); ?>
    </a>
    <a data-wysihtml5-command="italic" title="Kursiv" class="wysihtml5-command" href="javascript:;">
        <?php echo $this->Html->image('icons/italic.png'); ?>
    </a>
</div>

<div id="report">
    <p>
        <?=
        $this->Html->link('Bericht drucken',
            array('action' => 'export', $report['Report']['id']),
            array('id' => 'renose-print'))
        ?>
    </p>

    <p>

    <div>
        <b>Datum:</b>
        <?php echo date('d.m.Y', strtotime($report['Report']['date'])); ?>
        <br/>

        <b>Abteilung:</b>
        <?= $this->element('report/editfield', array(
            'id' => $report['Report']['id'],
            'field' => 'department',
            'data' => $report['Report']['department']
        )) ?>
    </div>
    <br/>
    
    <div class="hide-container">
        <input id="vacation" type="checkbox" class="hide-checkbox" data-field="vacation" data-id="<?= $report['ReportWeek']['id'] ?>" <?php if($report['ReportWeek']['vacation'] == 1) { echo 'checked="checked"'; } ?> />
        <label for="vacation">Urlaub</label>
        
        <div class="hide-element">
            <?php
                echo $this->element('report/week', array(
                    'header' => 'Tätigkeiten',
                    'icon' => 'icons/manager.png',
                    'id' => $report['ReportWeek']['id'],
                    'field' => 'activity',
                    'data' => $report['ReportWeek']['activity']
                ));

                echo $this->element('report/week', array(
                    'header' => 'Unterweisungen',
                    'icon' => 'icons/talk.png',
                    'id' => $report['ReportWeek']['id'],
                    'field' => 'instruction',
                    'data' => $report['ReportWeek']['instruction']
                ));
            ?>
        </div>
    </div>

    <h2>
        <?php echo $this->Html->image('icons/books.png'); ?>
        Schule
    </h2>

    <div class="hide-container">
        <input id="holiday" type="checkbox" class="hide-checkbox" data-field="holiday" data-id="<?= $report['ReportWeek']['id'] ?>" <?php if($report['ReportWeek']['holiday'] == 1) { echo 'checked="checked"'; } ?> />
        <label for="holiday">Ferien</label>

        <table class="school hide-element">
            <thead>
                <tr>
                    <th class="school-subject">Fach</th>
                    <th class="school-topic">Thema</th>
                </tr>
            </thead>
            <tbod>
                <?php
                foreach($lessons as $subject => $text)
                {
                    echo $this->element('report/school', array(
                        'id' => $report['Report']['id'],
                        'subject' => $subject,
                        'data' => $text
                    ));
                }
                ?>
            </tbod>
        </table>
    </div>
</div>

<script type="text/javascript">
    $('.editfield').editfield('<?php echo $this->Html->url(array('controller' => 'reports', 'action' => 'save')); ?>');
    
    $('#report .activity').editbox('<?php echo $this->Html->url(array('controller' => 'report_weeks', 'action' => 'save')); ?>');
    $('#report .instruction').editbox('<?php echo $this->Html->url(array('controller' => 'report_weeks', 'action' => 'save')); ?>');
    
    $('#report .school .edit-container').tableeditfield(
        '<?php echo $this->Html->url(array('controller' => 'report_week_school_subjects', 'action' => 'save')); ?>',
        '<?php echo $this->Html->url(array('controller' => 'report_week_school_subjects', 'action' => 'delete')); ?>'
    );
        
    $('.hide-container').hide_element('<?php echo $this->Html->url(array('controller' => 'report_weeks', 'action' => 'save')); ?>');
</script>

<?php
pr($report);
pr($lessons);