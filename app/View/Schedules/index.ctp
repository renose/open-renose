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
        for($i = 0; $i < $lesson_count + 1; $i++)
        {
            echo '<tr>';
            echo '<td class="lesson-number" data-id="null">' . ($i+1) . '</td>';
            
            for($n = 0; $n < 6; $n++)
            {
                if(isset($days[$n][$i]))
                {
                    echo '<td class="lesson-subject" data-exists="true" data-day="'. $n .'" data-number="'. $i .'">';
                    echo $days[$n][$i]['subject'];
                    
                    echo '</td>';
                }
                else
                    echo '<td class="lesson-subject" data-exists="false" data-day="'. $n .'" data-number="'. $i .'"></td>';
            }
            
            echo '</tr>';
        }
        ?>
    </tbod>
</table>

<script type="text/javascript">
    $('#schedule .lesson-subject').editable('<?php echo $this->Html->url('save'); ?>', {
        indicator: 'speichern...',
        tooltip: 'Zum Ändern klicken...',
        placeholder:'-',
        cancel: 'Abbrechen',
        submit: 'Ändern',
        height: 'none',
        width: 'none',
        submitdata: function(value, settings) {
            return {
                day: $(this).attr('data-day'),
                number: $(this).attr('data-number')
            };
        },
        callback : function(value, settings) {
            $(this).attr('data-exists', 'false');
            
            if($(this).attr('data-number') == ($('#schedule .lesson-number').length - 1))
            {
                alert('We need more water!');
            }
        }
    });
    
    $('#schedule .lesson-subject').mouseenter(function() {
        if($(this).attr('data-exists') == 'false')
            return false;
        
        var del = $('<?php echo $this->Html->image('icons/delete.png', array('class' => 'lesson-delete', 'alt' => 'Diese Stunde löschen')); ?>');
        
        $(del).click(function() {
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
        
        $(this).append(del);
    });
    $('#schedule .lesson-subject').mouseleave(function() {
        $(this).find('img').remove();
    });
</script>