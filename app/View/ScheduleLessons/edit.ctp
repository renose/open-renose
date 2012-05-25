<div class="scheduleLessons form">
<?php echo $this->Form->create('ScheduleLesson');?>
	<fieldset>
		<legend><?php echo __('Edit Schedule Lesson'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('schedule_id');
		echo $this->Form->input('day');
		echo $this->Form->input('number');
		echo $this->Form->input('subject');
		echo $this->Form->input('teacher');
		echo $this->Form->input('room');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ScheduleLesson.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ScheduleLesson.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Schedule Lessons'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Schedules'), array('controller' => 'schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule'), array('controller' => 'schedules', 'action' => 'add')); ?> </li>
	</ul>
</div>
