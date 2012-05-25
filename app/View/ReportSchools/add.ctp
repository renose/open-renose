<div class="reportSchools form">
<?php echo $this->Form->create('ReportSchool');?>
	<fieldset>
		<legend><?php echo __('Add Report School'); ?></legend>
	<?php
		echo $this->Form->input('report_id');
		echo $this->Form->input('subject');
		echo $this->Form->input('text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Report Schools'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
