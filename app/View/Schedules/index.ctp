<h1>
    <?php echo $this->Html->image('icons/planner.png'); ?>
    Stundenplan
</h1>
<br/>

<table id="schedule">
    <thead>
        <tr>
            <th>Std.</th>
            <th>Mo</th>
            <th>Di</th>
            <th>Mi</th>
            <th>Do</th>
            <th>Fr</th>
            <th>Sa</th>
        </tr>
    </thead>
    <tbod>
        <?php
        for ($i = 0; $i < $lesson_count + 1; $i++)
        {
            echo '<tr>';
            echo '<td class="lesson-number" data-id="null">' . ($i + 1) . '</td>';

            for ($n = 0; $n < 6; $n++)
            {
                if (isset($days[$n][$i]))
                {
                    echo '<td class="lesson" data-day="' . $n . '" data-number="' . $i . '">';
                    
                    echo '<div class="lesson-subject" data-exists="true">' . $days[$n][$i]['subject'] . '</div>';
                    echo $this->Html->image('icons/delete.png', array('class' => 'lesson-delete', 'alt' => 'Diese Stunde löschen'));

                    echo '</td>';
                }
                else
                {
                    echo '<td class="lesson" data-day="' . $n . '" data-number="' . $i . '">';
                    echo '<div class="lesson-subject" data-exists="false"></div>';
                    echo $this->Html->image('icons/delete.png', array('class' => 'lesson-delete', 'alt' => 'Diese Stunde löschen'));
                    echo '</td>';
                }
            }

            echo '</tr>';
        }
        ?>
    </tbod>
</table>

<script type="text/javascript">
    $('#schedule .lesson-delete').hide('fast');
    $('#schedule .lesson-delete').click(function() {
        var that = this;
        $.ajax({
            url: '<?php echo $this->Html->url('delete'); ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                day: $(that).parent().attr('data-day'),
                number: $(that).parent().attr('data-number')
            },
            success: function(data) {
                console.log(data);

                if(data.status == 'ok')
                {
                    $(that).parent().attr('data-exists', 'false');
                    $(that).parent().html('-');
                }
                else
                    alert('Fehler beim Speichern :(');
            }
        });

        return false;
    });
    
    $('#schedule .lesson').mouseenter(function() {
        if($(this).find('.lesson-subject').attr('data-exists') == 'true')
            $(this).find('img').show('fast');
    });
    $('#schedule .lesson').mouseleave(function() {
        $(this).find('img').hide('fast');
    });
    
    editable($('#schedule .lesson-subject'));
    $('#schedule .lesson').click(function() {
        $(this).find('.lesson-subject').click();
    });
    
    function editable(elements)
    {
        elements.editable('<?php echo $this->Html->url('save'); ?>', {
            loadtext: 'bitte warten...',
            indicator: 'speichern...',
            placeholder: '-',
            tooltip: 'Zum Ändern klicken...',
            cancel: 'Abbrechen',
            submit: 'Ändern',
            height: 'none',
            width: 'none',
            submitdata: function(value, settings) {
                return {
                    day: $(this).parent().attr('data-day'),
                    number: $(this).parent().attr('data-number')
                };
            },
            callback : function(value, settings) {
                $(this).attr('data-exists', 'true');

                if($(this).parent().attr('data-number') == ($('#schedule .lesson-number').length - 1))
                    addLine();
            }
        });
    }
    function addLine()
    {
        var number = $('#schedule .lesson-number').length + 1;
        var line = '<tr><td class="lesson-number" data-id="null">' + number + '</td>';
        
        for(var i=0; i < 6; i++)
        {
            line = '<td class="lesson" data-day="0" data-number="2">';
            line = '<div class="lesson-subject" data-exists="false" title="Zum Ändern klicken..." style="">-</div>';
            line = '<img src="/renose/img/icons/delete.png" class="lesson-delete" alt="Diese Stunde löschen" style="display: none; ">';
            line = '</td>';
        }
        
        line = '</tr>';
        
        $('#schedule tbody').append(line);
        //editable($(line).find('.lesson-subject'));
    }
</script>