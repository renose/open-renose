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
    <p>
        <?=
        $this->Html->link('Bericht drucken',
            array('action' => 'export', $report['Report']['id']),
            array('id' => 'renose-print'))
        ?>
    </p>
    
    <p>
        <b>Datum:</b>
        <?php echo date('d.m.Y', strtotime($report['Report']['date'])); ?>
        <br/>
        
        <b>Abteilung:</b>
        <?php echo $report['Report']['department']; ?>
    </p>
    
    <h2>
        <?php echo $this->Html->image('icons/manager.png'); ?>
        Tätigkeiten
    </h2>
    
    <?php
        echo '<div id="ReportActivity" class="edit-container" data-report="'. $report['Report']['id'] .'">';
        
        if(isset($report['ReportActivity']['id']))
        {
            echo '<div class="edit-textbox" data-exists="true">';
            echo $report['ReportActivity']['text'];
            echo '</div>';
        }
        else
            echo '<div class="edit-textbox" data-exists="false"></div>';
        
        echo $this->Html->image('icons/delete.png', array('class' => 'activity-delete edit-delete', 'alt' => 'Diese Aktivität löschen'));
        echo '<div style="clear: both;"></div></div>';
    ?>
    <br/>

    <h2>
        <?php echo $this->Html->image('icons/talk.png'); ?>
        Unterweisungen
    </h2>
    
    <?php
        echo '<div id="ReportInstruction" class="edit-container" data-report="'. $report['Report']['id'] .'">';
        
        if(isset($report['ReportInstruction']['id']))
        {
            echo '<div class="edit-textbox" data-exists="true">';
            echo $report['ReportInstruction']['text'];
            echo '</div>';
        }
        else
            echo '<div class="edit-textbox" data-exists="false"></div>';
        
        echo $this->Html->image('icons/delete.png', array('class' => 'activity-delete edit-delete', 'alt' => 'Diese Aktivität löschen'));
        echo '<div style="clear: both;"></div></div>';
    ?>
    <br/>

    <h2>
        <?php echo $this->Html->image('icons/books.png'); ?>
        Schule
    </h2>
    
    <table class="school">
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
                echo '<tr>';
                echo '<td class="school-subject">' . $subject . '</td>';
                
                if ($text != null)
                {
                    echo '<td class="school-topic edit-container" data-report="'. $report['Report']['id'] .'" data-subject="'. $subject .'">';
                    
                    echo '<div class="school-topic-text edit-textbox" data-exists="true">' . $text . '</div>';
                    echo $this->Html->image('icons/delete.png', array('class' => 'school-topic-delete edit-delete', 'alt' => 'Dieses Thema löschen'));

                    echo '</td>';
                }
                else
                {
                    echo '<td class="school-topic edit-container" data-report="'. $report['Report']['id'] .'" data-subject="'. $subject .'">';
                    echo '<div class="school-topic-text edit-textbox" data-exists="false"></div>';
                    echo $this->Html->image('icons/delete.png', array('class' => 'school-topic-delete edit-delete', 'alt' => 'Dieses Thema löschen'));
                    echo '</td>';
                }
            }
            ?>
        </tbod>
    </table>
</div>

<script type="text/javascript">

    editable($('#ReportActivity'), '<?php echo $this->Html->url(array('controller' => 'report_activities')); ?>');
    editable($('#ReportInstruction'), '<?php echo $this->Html->url(array('controller' => 'report_instructions')); ?>');

    function editable(element, url)
    {
        $(element).find('.edit-delete').hide();
        $(element).find('.edit-delete').click(function() {
            var that = this;
            $.ajax({
                url: url + '/delete',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    report_id: $(that).parent().attr('data-report')
                },
                success: function(data) {
                    if(data.status.code > 0)
                    {
                        $(that).parent().find('.edit-textbox').attr('data-exists', 'false');
                        $(that).parent().find('.edit-textbox').html('-');
                    }
                    else
                    {
                        console.log(data);
                        $.jGrowl(data.message, { header: 'Fehler', life: 10000 });
                    }
                }
            });

            return false;
        });
        
        $(element).mouseenter(function() {
            if($(this).find('.edit-textbox').attr('data-exists') == 'true')
                $(this).find('.edit-delete').css('display', '');
        });
        $(element).mouseleave(function() {
            $(this).find('.edit-delete').css('display', 'none');
        });
        
        element.find('.edit-textbox').editable(url + '/save', {
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
                    report_id: $(this).parent().attr('data-report')
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
    
    init_school($('#report .school'));
    
    function init_school(elements)
    {
        $(elements).find('.edit-delete').hide();
        $(elements).find('.edit-delete').click(function() {
            var that = this;
            $.ajax({
                url: '<?php echo $this->Html->url(array('controller' => 'report_schools', 'action' => 'delete')); ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    report_id: $(that).parent().attr('data-report'),
                    subject: $(that).parent().attr('data-subject')
                },
                success: function(data) {
                    if(data.status.code > 0)
                    {
                        $(that).parent().find('.edit-textbox').attr('data-exists', 'false');
                        $(that).parent().find('.edit-textbox').html('-');
                    }
                    else
                    {
                        console.log(data);
                        $.jGrowl(data.message, { header: 'Fehler', life: 10000 });
                    }
                }
            });

            return false;
        });

        $(elements).find('.edit-container').mouseenter(function() {
            if($(this).find('.edit-textbox').attr('data-exists') == 'true')
                $(this).find('.edit-delete').css('display', '');
        });
        $(elements).find('.edit-container').mouseleave(function() {
            $(this).find('.edit-delete').css('display', 'none');
        });

        editable_school($(elements).find('.edit-textbox'));
    }
    
    function editable_school(elements)
    {
        elements.editable('<?php echo $this->Html->url(array('controller' => 'report_schools', 'action' => 'save')); ?>', {
            loadtext: 'bitte warten...',
            indicator: 'speichern...',
            placeholder: '-',
            tooltip: 'Zum Ändern klicken...',
            submit: 'Ändern',
            cancel: 'Abbrechen',
            height: 'none',
            width: 'none',
            submitdata: function(value, settings) {
                return {
                    report_id: $(this).parent().attr('data-report'),
                    subject: $(this).parent().attr('data-subject')
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

<?php
pr($lessons);
pr($report);
