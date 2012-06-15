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
                    echo '<td class="school-topic edit-field" data-report="'. $report['Report']['id'] .'" data-subject="'. $subject .'">';
                    
                    echo '<div class="school-topic-text" data-exists="true">' . $text . '</div>';
                    echo $this->Html->image('icons/delete.png', array('class' => 'school-topic-delete', 'alt' => 'Dieses Thema löschen'));

                    echo '</td>';
                }
                else
                {
                    echo '<td class="school-topic edit-field" data-report="'. $report['Report']['id'] .'" data-subject="'. $subject .'">';
                    echo '<div class="school-topic-text" data-exists="false"></div>';
                    echo $this->Html->image('icons/delete.png', array('class' => 'school-topic-delete', 'alt' => 'Dieses Thema löschen'));
                    echo '</td>';
                }
            }
            ?>
        </tbod>
    </table>
</div>

<script type="text/javascript">
    
    editable($('#ReportActivity'), '<?php echo $this->Html->url(array('controller' => 'report_activities', 'action' => 'save')); ?>');
    editable($('#ReportInstruction'), '<?php echo $this->Html->url(array('controller' => 'report_instructions', 'action' => 'save')); ?>');
    
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
    
    init_school($('#report .school'));
    
    function init_school(elements)
    {
        $(elements).find('.school-topic-delete').hide();
        $(elements).find('.school-topic-delete').click(function() {
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
                        $(that).parent().attr('data-exists', 'false');
                        $(that).parent().find('.school-topic-text').html('-');
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

        $(elements).find('.school-topic').mouseenter(function() {
            if($(this).find('.school-topic-text').attr('data-exists') == 'true')
                $(this).find('img').css('display', '');
        });
        $(elements).find('.school-topic').mouseleave(function() {
            $(this).find('img').css('display', 'none');
        });

        editable_school($(elements).find('.school-topic-text'));
        $(elements).find('.school-topic').click(function(e) {
            if($(this).find('input').length == 0)
                $(this).find('.school-topic-text').click();
        });
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