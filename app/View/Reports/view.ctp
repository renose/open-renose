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

    <?php
        echo $this->element('report/week', array(
            'header' => 'Tätigkeiten',
            'icon' => 'icons/manager.png',
            'id' => $report['Report']['id'],
            'field' => 'activity',
            'data' => $report['Report']['activity']
        ));
        
        echo $this->element('report/week', array(
            'header' => 'Unterweisungen',
            'icon' => 'icons/talk.png',
            'id' => $report['Report']['id'],
            'field' => 'instruction',
            'data' => $report['Report']['instruction']
        ));
    ?>

    <h2>
        <?php echo $this->Html->image('icons/books.png'); ?>
        Schule
    </h2>

    <input type="checkbox" id="holidays" value="holidays" data-field="holiday" data-report="<?= $report['Report']['id'] ?>" <?php if($report['Report']['holiday'] == 1) { echo 'checked="checked"'; } ?> />
    <label for="holidays">Ferien</label>

    <script type="text/javascript">
        jQuery('input#holidays').click(function () {
            var table = jQuery('table.school');
            var checked = $('input#holidays:checked').length != 0;

            if(checked)
                table.fadeOut();
            else
                table.fadeIn();

            $.ajax({
                url : '<?php echo $this->Html->url(array('controller' => 'reports', 'action' => 'save')); ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    report_id: $(this).attr('data-report'),
                    field: $(this).attr('data-field'),
                    value: (checked ? 1 : 0)
                },
                success : function(data)
                {
                    if(data.status.code > 0)
                        $.jGrowl('Ferien erfolgreich gespeichert.');
                    else
                    {
                        console.log(data);
                        $.jGrowl(data.message, { header: 'Fehler', life: 10000 });
                    }
                }
            });

        });

        jQuery('input#holidays').ready(function () {
            var table = jQuery('table.school');

            if(jQuery('input#holidays:checked').length != 0) {
                table.hide();
            }
        });
    </script>

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

<script type="text/javascript">

    $('.editfield').editfield('<?php echo $this->Html->url(array('action' => 'save')); ?>');

    $('#report .activity').editbox('<?php echo $this->Html->url(array('action' => 'save')); ?>');
    $('#report .instruction').editbox('<?php echo $this->Html->url(array('action' => 'save')); ?>');

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
                    id: $(that).parent().attr('data-id'),
                    subject: $(that).parent().attr('data-subject')
                },
                success: function(data) {
                    if(data.status.code > 0)
                    {
                        $(that).parent().find('.edit-textbox').attr('data-exists', 'false');
                        $(that).parent().find('.edit-textbox').html('-');
                        $.jGrowl('Löschen erfolgreich.');
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
                    id: $(this).parent().attr('data-id'),
                    subject: $(this).parent().attr('data-subject')
                };
            },
            callback : function(value, settings) {

                var data = jQuery.parseJSON(value);

                if(data.status.code > 0)
                {
                    $(this).html(data.data);
                    $(this).attr('data-exists', 'true');
                    $.jGrowl('Änderung erfolgreich gespeichert.');
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
