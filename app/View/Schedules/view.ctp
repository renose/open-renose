<div class="schedules view">
<h2><?php  echo __('Schedule');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($schedule['Schedule']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($schedule['User']['email'], array('controller' => 'users', 'action' => 'view', $schedule['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Schedule'), array('action' => 'edit', $schedule['Schedule']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Schedule'), array('action' => 'delete', $schedule['Schedule']['id']), null, __('Are you sure you want to delete # %s?', $schedule['Schedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedules'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedule Lessons'), array('controller' => 'schedule_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule Lesson'), array('controller' => 'schedule_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Schedule Lessons');?></h3>
	<?php if (!empty($schedule['ScheduleLesson'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Schedule Id'); ?></th>
		<th><?php echo __('Day'); ?></th>
		<th><?php echo __('Number'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Teacher'); ?></th>
		<th><?php echo __('Room'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($schedule['ScheduleLesson'] as $scheduleLesson): ?>
		<tr>
			<td><?php echo $scheduleLesson['id'];?></td>
			<td><?php echo $scheduleLesson['schedule_id'];?></td>
			<td><?php echo $scheduleLesson['day'];?></td>
			<td><?php echo $scheduleLesson['number'];?></td>
			<td><?php echo $scheduleLesson['subject'];?></td>
			<td><?php echo $scheduleLesson['teacher'];?></td>
			<td><?php echo $scheduleLesson['room'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'schedule_lessons', 'action' => 'view', $scheduleLesson['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'schedule_lessons', 'action' => 'edit', $scheduleLesson['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'schedule_lessons', 'action' => 'delete', $scheduleLesson['id']), null, __('Are you sure you want to delete # %s?', $scheduleLesson['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Schedule Lesson'), array('controller' => 'schedule_lessons', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
