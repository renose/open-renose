<div class="calendarEntries view">
<h2><?php  echo __('Calendar Entry');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($calendarEntry['CalendarEntry']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($calendarEntry['CalendarEntry']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Day'); ?></dt>
		<dd>
			<?php echo h($calendarEntry['CalendarEntry']['day']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($calendarEntry['CalendarEntry']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Calendar Entry'), array('action' => 'edit', $calendarEntry['CalendarEntry']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Calendar Entry'), array('action' => 'delete', $calendarEntry['CalendarEntry']['id']), null, __('Are you sure you want to delete # %s?', $calendarEntry['CalendarEntry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Calendar Entries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calendar Entry'), array('action' => 'add')); ?> </li>
	</ul>
</div>
