<?php
    $this->Html->addCrumb('Berichte', 'display');
    $this->Html->addCrumb($report['Report']['year'], array('action' => 'display', $report['Report']['year']));
    $this->Html->addCrumb('Bericht ' . $report['Report']['number']);
?>

<h1>
    <?php
        echo $this->Html->image('icons/clipboard.png');
        echo $title_for_layout;
    ?>
</h1>
<br/>

<div id="report">
    <h2>
        <?php echo $this->Html->image('icons/manager.png'); ?>
        Tätigkeiten
    </h2>
    <div id="wysihtml5-toolbar" style="display: none;">
        <ul class="commands">
            <li data-wysihtml5-command="bold" title="Fett" class="command" href="javascript:;" unselectable="on">
                <?php echo $this->Html->image('icons/bold.png'); ?>
            </li>
            <li data-wysihtml5-command="italic" title="Kursiv" class="command" href="javascript:;" unselectable="on">
                <?php echo $this->Html->image('icons/italic.png'); ?>
            </li>
        </ul>
    </div>
    <?php
        if(isset($report['ReportActivity']))
        {
            echo '<div id="ReportActivity" class="edit-field" data-report="'. $report['Report']['id'] .'" data-exists="true">';
            echo $report['ReportActivity']['text'];
            echo '</div>';
            //echo $this->Html->image('icons/delete.png', array('class' => 'delete-icon', 'alt' => 'Diesen Eintrag löschen'));
        }
        else
        {
            echo '<div id="ReportActivity" data-report="'. $report['Report']['id'] .'" data-exists="false"></div>';
            //echo $this->Html->image('icons/delete.png', array('class' => 'delete-icon', 'alt' => 'Diesen Eintrag löschen'));
        }
    ?>
    <br/>

    <h2>
        <?php echo $this->Html->image('icons/talk.png'); ?>
        Unterweisungen
    </h2>
    <div>
    <?php
        foreach ($report['ReportInstruction'] as $reportInstruction)
        {
            echo '<i>' . $reportInstruction['title'] . '</i> ';

            echo $this->Html->link(
                    $this->Html->image("icon/edit.png", array("alt" => "Unterweisung bearbeiten", "align" => "center")),
                    array('controller' => 'report_instructions', 'action' => 'edit', $reportInstruction['id']), array('escape' => false) );

            echo ' ';

            echo $this->Html->link(
                    $this->Html->image("icon/delete.png", array("alt" => "Unterweisung löschen", "align" => "center")),
                    array('controller' => 'report_instructions', 'action' => 'delete', $reportInstruction['id']), array('escape' => false),
                    'Wollen Sie diese Unterweisung wirklich löschen?');

            echo '<dir>';
            echo str_replace("\n", "<br/>", $reportInstruction['text']);
            //echo $reportInstruction['text'];
            echo '</dir>';

            echo '<br/>';
        }
    ?>
    </div>
    <?php
        echo $this->Html->link(
                $this->Html->image("icon/add.png", array("alt" => "Unterweisung hinzufügen", "align" => "center", "id" => "ico-addpage")),
                array('controller' => 'report_instructions', 'action' => 'add', $report['Report']['id']),
                array('escape' => false));
    ?>
    <br/>
    
    <h2>
        <?php echo $this->Html->image('icons/books.png'); ?>
        Schule
    </h2>
</div>

<script type="text/javascript">
    
    editable($('#ReportActivity'), '<?php echo $this->Html->url(array('controller' => 'report_activities', 'action' => 'save')); ?>');
    
    function editable(elements, url)
    {
        elements.editable(url, {
            type: 'wysihtml5',
            loadtext: 'bitte warten...',
            indicator: 'speichern...',
            placeholder: '-',
            tooltip: 'Zum Ändern klicken...',
            submit: 'Speichern',
            cancel: 'Abbrechen',
            height: 'none',
            width: 'none',
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