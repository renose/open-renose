<?php
    $this->Html->addCrumb('Berichte');
    $this->Html->addCrumb('Übersicht', array('action' => 'display', $report['Report']['year']));
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
    <p><?= $this->Html->link('Bericht drucken', array(
        'action' => 'export',
        $report['Report']['id']
    ), array('id' => 'renose-print')) ?></p>
    <h2>
        <?php echo $this->Html->image('icons/manager.png'); ?>
        Tätigkeiten
    </h2>
    <?php
        if(isset($report['ReportActivity']))
        {
            echo '<div id="ReportActivity" class="edit-field" data-report="'. $report['Report']['id'] .'" data-exists="true">';
            echo $report['ReportActivity']['text'];
            echo '</div>';
        }
        else
        {
            echo '<div id="ReportActivity" data-report="'. $report['Report']['id'] .'" data-exists="false"></div>';
        }
    ?>
    <br/>

    <h2>
        <?php echo $this->Html->image('icons/talk.png'); ?>
        Unterweisungen
    </h2>
    <?php
        if(isset($report['ReportInstruction']))
        {
            echo '<div id="ReportInstruction" class="edit-field" data-report="'. $report['Report']['id'] .'" data-exists="true">';
            echo $report['ReportInstruction']['text'];
            echo '</div>';
        }
        else
        {
            echo '<div id="ReportInstruction" data-report="'. $report['Report']['id'] .'" data-exists="false"></div>';
        }
    ?>
    <br/>

    <h2>
        <?php echo $this->Html->image('icons/books.png'); ?>
        Schule
    </h2>
</div>

<script type="text/javascript">

    editable($('#ReportActivity'), '<?php echo $this->Html->url(array('controller' => 'report_activities', 'action' => 'save')); ?>');
    editable($('#ReportInstruction'), '<?php echo $this->Html->url(array('controller' => 'report_instructions', 'action' => 'save')); ?>');

    function editable(elements, url)
    {
        elements.editable(url, {
            type: 'wysihtml5',
            loadtext: 'Bitte warten...',
            indicator: 'Speichern...',
            placeholder: '-',
            tooltip: 'Zum Ändern klicken...',
            submit: 'Speichern',
            cancel: 'Abbrechen',
            height: 'none',
            width: 'none',
            rows: 10,
            submitdata: function(value, settings) {
                return {
                    report_id: $(this).attr('data-report')
                };
            },
            callback : function(value, settings) {

                var data = jQuery.parseJSON(value);

                if(data.status.code > 0)
                {
                    $(this).html(data.data);
                    $(this).attr('data-exists', 'true');
                }
                else
                {
                    console.log(data);
                    $.jGrowl(data.message, { header: 'Fehler', life: 10000 });

                    $(this).html('Fehler');
                }

            }
        });
    }
</script>

<?php pr($report);