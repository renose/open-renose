<div class="schedules form">
<?php echo $this->Form->create('Schedule');?>
	<fieldset>
		<legend><?php echo __('Add Schedule'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Schedules'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedule Lessons'), array('controller' => 'schedule_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule Lesson'), array('controller' => 'schedule_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
