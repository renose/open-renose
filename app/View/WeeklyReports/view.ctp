<?php
    $this->Html->addCrumb('Berichte');
    $this->Html->addCrumb('Übersicht', array('controller' => 'reports', 'action' => 'display', $report['WeeklyReport']['year']));
    $this->Html->addCrumb('Bericht ' . $report['WeeklyReport']['number']);
?>

<nav id="content-toolbar">
    <a id="renose-print" href="<?= $this->Html->url(array('action' => 'export', $report['WeeklyReport']['id'])) ?>">
        <?= $this->Html->image('icons/pdf.png', array('class' => 'icon-small')) ?>
        Export
    </a>

    <a href="<?= $this->Html->url(array('action' => 'delete', $report['WeeklyReport']['id'])) ?>">
        <?= $this->Html->image('icons/delete.png', array('class' => 'icon-small')) ?>
        Löschen
    </a>
</nav>

<h1>
    <?php
        echo $this->Html->image('icons/clipboard.png');
        echo $title_for_layout;
    ?>
</h1>

<div id="report">
    <div>
        für die Zeit vom <?= date('d.m.Y', strtotime($report['WeeklyReport']['from'])) ?>
        bis <?= date('d.m.Y', strtotime($report['WeeklyReport']['to'])) ?>
        <br/><br/>
        
        <?= $this->Editfield->inputfield('Datum', 'date', $report['WeeklyReport']['id'], $report['WeeklyReport']['date'], array('type' => 'date')) ?>
        <?= $this->Editfield->inputfield('Abteilung', 'department', $report['WeeklyReport']['id'], $report['WeeklyReport']['department']) ?>
    </div>
    <br/>
    
    <div id="wysihtml5-toolbar" class="wysihtml5-toolbar" style="display: none;">
        <a data-wysihtml5-command="bold" title="Fett" class="wysihtml5-command" href="javascript:;">
            <?php echo $this->Html->image('icons/bold.png'); ?>
        </a>
        <a data-wysihtml5-command="italic" title="Kursiv" class="wysihtml5-command" href="javascript:;">
            <?php echo $this->Html->image('icons/italic.png'); ?>
        </a>
    </div>
    
    <div class="hide-container">
        <input id="vacation" type="checkbox" class="hide-checkbox" data-field="vacation" data-id="<?= $report['WeeklyReport']['id'] ?>" <?php if($report['WeeklyReport']['vacation'] == 1) { echo 'checked="checked"'; } ?> />
        <label for="vacation">Urlaub</label>
        
        <div class="hide-element">
            <h2>
                <?= $this->Html->image('icons/manager.png'); ?>
                Tätigkeiten
            </h2>
            <?= $this->Editfield->editbox('activity', $report['WeeklyReport']['id'], $report['WeeklyReport']['activity']) ?>
            
            <h2>
                <?= $this->Html->image('icons/talk.png'); ?>
                Unterweisungen
            </h2>
            <?= $this->Editfield->editbox('instruction', $report['WeeklyReport']['id'], $report['WeeklyReport']['instruction']) ?>
        </div>
    </div>

    <h2>
        <?php echo $this->Html->image('icons/books.png'); ?>
        Schule
    </h2>

    <div class="hide-container">
        <input id="holiday" type="checkbox" class="hide-checkbox" data-field="holiday" data-id="<?= $report['WeeklyReport']['id'] ?>" <?php if($report['WeeklyReport']['holiday'] == 1) { echo 'checked="checked"'; } ?> />
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
                        'id' => $report['WeeklyReport']['id'],
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
    $('.inputfield').inputfield('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    $('.editbox').editbox('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    
    $('#report .school .edit-container').tableeditfield(
        '<?php echo $this->Html->url(array('controller' => 'weekly_report_school_entries', 'action' => 'save')); ?>',
        '<?php echo $this->Html->url(array('controller' => 'weekly_report_school_entries', 'action' => 'delete')); ?>'
    );
        
    $('.hide-container').hide_element('<?php echo $this->Html->url(array('action' => 'save')); ?>');
</script>

<?php
pr($report);
pr($lessons);