<div class="calendarEntries form">
<?php echo $this->Form->create('CalendarEntry');?>
	<fieldset>
		<legend><?php echo __('Add Calendar Entry'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Calendar Entries'), array('action' => 'index'));?></li>
	</ul>
</div>
