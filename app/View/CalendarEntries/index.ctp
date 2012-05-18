<div class="calendarEntries index">
	<h2><?php echo __('Calendar Entries');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('day');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($calendarEntries as $calendarEntry): ?>
	<tr>
		<td><?php echo h($calendarEntry['CalendarEntry']['id']); ?>&nbsp;</td>
		<td><?php echo h($calendarEntry['CalendarEntry']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($calendarEntry['CalendarEntry']['day']); ?>&nbsp;</td>
		<td><?php echo h($calendarEntry['CalendarEntry']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $calendarEntry['CalendarEntry']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $calendarEntry['CalendarEntry']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $calendarEntry['CalendarEntry']['id']), null, __('Are you sure you want to delete # %s?', $calendarEntry['CalendarEntry']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Calendar Entry'), array('action' => 'add')); ?></li>
	</ul>
</div>
