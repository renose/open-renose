<?php
    $this->Html->addCrumb('Main');
    $this->Html->addCrumb('Stundenplan', array('action' =>'index'));
?>
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
        for($lesson = 0; $lesson <= $max_lesson + 1; $lesson)
        {
            echo '<tr>';
            echo '<td class="lesson-number" data-id="null">' . ($lesson + 1) . '</td>';

            for ($n = 0; $n < 6; $n++)
            {
                if (isset($days[$n][$lesson]))
                {
                    echo '<td class="lesson edit-container" data-day="' . $n . '" data-number="' . $lesson . '">';
                    
                    echo '<div class="edit-textbox" data-exists="true">' . $days[$n][$lesson]['subject'] . '</div>';
                    echo $this->Html->image('icons/delete.png', array('class' => 'edit-delete', 'alt' => 'Diese Stunde löschen'));

                    echo '</td>';
                }
                else
                {
                    echo '<td class="lesson edit-container" data-day="' . $n . '" data-number="' . $lesson . '">';
                    echo '<div class="edit-textbox" data-exists="false"></div>';
                    echo $this->Html->image('icons/delete.png', array('class' => 'edit-delete', 'alt' => 'Diese Stunde löschen'));
                    echo '</td>';
                }
            }

            echo '</tr>';
            
            $lesson++;
        }
        ?>
    </tbod>
</table>

<script type="text/javascript">
    
    $('.edit-container').tableeditfield(
        '<?php echo $this->Html->url(array('action' => 'save')); ?>',
        '<?php echo $this->Html->url(array('action' => 'delete')); ?>'
    );
    
    function addLine()
    {
        var number = $('#schedule .lesson-number').length;
        var line = '<tr><td class="lesson-number" data-id="null">' + (number+1) + '</td>';
        
        for(var i=0; i < 6; i++)
        {
            line += '<td class="lesson" data-day="' + i + '" data-number="' + number + '">';
            line += '<div class="lesson-subject" data-exists="false"></div>';
            line += '<?= $this->Html->image('icons/delete.png', array('class' => 'lesson-delete', 'alt' => 'Diese Stunde löschen')) ?>';
            line += '</td>';
        }
        
        line += '</tr>';
        
        $('#schedule tbody').append(line);
        init($('#schedule tr').last());
    }
</script>