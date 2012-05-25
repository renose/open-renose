<div class="calendarEntries form">
<?php echo $this->Form->create('CalendarEntry');?>
	<fieldset>
		<legend><?php echo __('Edit Calendar Entry'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('day');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CalendarEntry.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CalendarEntry.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Calendar Entries'), array('action' => 'index'));?></li>
	</ul>
</div>
