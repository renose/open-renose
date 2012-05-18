<div class="scheduleLessons index">
	<h2><?php echo __('Schedule Lessons');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('schedule_id');?></th>
			<th><?php echo $this->Paginator->sort('day');?></th>
			<th><?php echo $this->Paginator->sort('number');?></th>
			<th><?php echo $this->Paginator->sort('subject');?></th>
			<th><?php echo $this->Paginator->sort('teacher');?></th>
			<th><?php echo $this->Paginator->sort('room');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($scheduleLessons as $scheduleLesson): ?>
	<tr>
		<td><?php echo h($scheduleLesson['ScheduleLesson']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($scheduleLesson['Schedule']['id'], array('controller' => 'schedules', 'action' => 'view', $scheduleLesson['Schedule']['id'])); ?>
		</td>
		<td><?php echo h($scheduleLesson['ScheduleLesson']['day']); ?>&nbsp;</td>
		<td><?php echo h($scheduleLesson['ScheduleLesson']['number']); ?>&nbsp;</td>
		<td><?php echo h($scheduleLesson['ScheduleLesson']['subject']); ?>&nbsp;</td>
		<td><?php echo h($scheduleLesson['ScheduleLesson']['teacher']); ?>&nbsp;</td>
		<td><?php echo h($scheduleLesson['ScheduleLesson']['room']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $scheduleLesson['ScheduleLesson']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $scheduleLesson['ScheduleLesson']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $scheduleLesson['ScheduleLesson']['id']), null, __('Are you sure you want to delete # %s?', $scheduleLesson['ScheduleLesson']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Schedule Lesson'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Schedules'), array('controller' => 'schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule'), array('controller' => 'schedules', 'action' => 'add')); ?> </li>
	</ul>
</div>
