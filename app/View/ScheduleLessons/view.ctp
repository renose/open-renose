<div class="scheduleLessons view">
<h2><?php  echo __('Schedule Lesson');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($scheduleLesson['ScheduleLesson']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Schedule'); ?></dt>
		<dd>
			<?php echo $this->Html->link($scheduleLesson['Schedule']['id'], array('controller' => 'schedules', 'action' => 'view', $scheduleLesson['Schedule']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Day'); ?></dt>
		<dd>
			<?php echo h($scheduleLesson['ScheduleLesson']['day']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($scheduleLesson['ScheduleLesson']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($scheduleLesson['ScheduleLesson']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Teacher'); ?></dt>
		<dd>
			<?php echo h($scheduleLesson['ScheduleLesson']['teacher']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Room'); ?></dt>
		<dd>
			<?php echo h($scheduleLesson['ScheduleLesson']['room']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Schedule Lesson'), array('action' => 'edit', $scheduleLesson['ScheduleLesson']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Schedule Lesson'), array('action' => 'delete', $scheduleLesson['ScheduleLesson']['id']), null, __('Are you sure you want to delete # %s?', $scheduleLesson['ScheduleLesson']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedule Lessons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule Lesson'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedules'), array('controller' => 'schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule'), array('controller' => 'schedules', 'action' => 'add')); ?> </li>
	</ul>
</div>
