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
    
    init($('#schedule'));
    
    function init(elements)
    {
        $(elements).find('.lesson-delete').hide();
        $(elements).find('.lesson-delete').click(function() {
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

        $(elements).find('.lesson').mouseenter(function() {
            if($(this).find('.lesson-subject').attr('data-exists') == 'true')
                $(this).find('img').css('display', '');
        });
        $(elements).find('.lesson').mouseleave(function() {
            $(this).find('img').css('display', 'none');
        });

        editable($(elements).find('.lesson-subject'));
        $(elements).find('.lesson').click(function(e) {
            if($(this).find('input').length == 0)
                $(this).find('.lesson-subject').click();
        });
    }
    
    function editable(elements)
    {
        elements.editable('<?php echo $this->Html->url('save'); ?>', {
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
        var number = $('#schedule .lesson-number').length;
        var line = '<tr><td class="lesson-number" data-id="null">' + (number+1) + '</td>';
        
        for(var i=0; i < 6; i++)
        {
            line += '<td class="lesson" data-day="' + i + '" data-number="' + number + '">';
            line += '<div class="lesson-subject" data-exists="false"></div>';
            line += '<img src="/renose/img/icons/delete.png" class="lesson-delete" alt="Diese Stunde löschen">';
            line += '</td>';
        }
        
        line += '</tr>';
        
        $('#schedule tbody').append(line);
        init($('#schedule tr').last());
    }
</script>