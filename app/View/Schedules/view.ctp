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
        for($lesson = 0; $lesson <= $max_lesson + 2; $lesson)
        {
            echo '<tr>';
            echo '<td class="lesson-number">' . ($lesson + 1) . '</td>';

            for ($n = 0; $n < 6; $n++)
            {
                $exists = isset($days[$n][$lesson]);
                echo '<td class="lesson edit-container" data-day="' . $n . '" data-number="' . $lesson . '">';
                
                echo '<div class="edit-textbox" data-exists="'. ($exists ? 'true' : 'false') .'">';
                if($exists)
                    echo $days[$n][$lesson]['subject'];
                echo '</div>';
                
                echo $this->Html->image('icons/delete.png', array('class' => 'edit-delete', 'alt' => 'Diese Stunde löschen'));

                echo '</td>';
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
    
    $('.edit-textbox').change(function(){
        var lines = $('#schedule tr');
        var data_exists =
            lines.eq(-1).find('.edit-textbox[data-exists=true]').length > 0 ||
            lines.eq(-2).find('.edit-textbox[data-exists=true]').length > 0;
        
        if(data_exists)
            addLine();
    });
    
    function addLine()
    {
        var number = $('#schedule .lesson-number').length;
        var line = '<tr><td class="lesson-number">' + (number+1) + '</td>';
        
        for(var i=0; i < 6; i++)
        {
            line += '<td class="lesson edit-container" data-day="' + i + '" data-number="' + number + '">';
            line += '<div class="edit-textbox" data-exists="false"></div>';
            line += '<?= $this->Html->image('icons/delete.png', array('class' => 'edit-delete', 'alt' => 'Diese Stunde löschen')) ?>';
            line += '</td>';
        }
        
        line += '</tr>';
        
        $('#schedule tbody').append(line);
        $('#schedule tr').last().find('.edit-container').tableeditfield(
            '<?php echo $this->Html->url(array('action' => 'save')); ?>',
            '<?php echo $this->Html->url(array('action' => 'delete')); ?>'
        );
    }
</script>