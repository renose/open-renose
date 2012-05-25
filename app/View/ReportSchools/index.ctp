<div class="reportSchools index">
	<h2><?php echo __('Report Schools');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('report_id');?></th>
			<th><?php echo $this->Paginator->sort('subject');?></th>
			<th><?php echo $this->Paginator->sort('text');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($reportSchools as $reportSchool): ?>
	<tr>
		<td><?php echo h($reportSchool['ReportSchool']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reportSchool['Report']['id'], array('controller' => 'reports', 'action' => 'view', $reportSchool['Report']['id'])); ?>
		</td>
		<td><?php echo h($reportSchool['ReportSchool']['subject']); ?>&nbsp;</td>
		<td><?php echo h($reportSchool['ReportSchool']['text']); ?>&nbsp;</td>
		<td><?php echo h($reportSchool['ReportSchool']['created']); ?>&nbsp;</td>
		<td><?php echo h($reportSchool['ReportSchool']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $reportSchool['ReportSchool']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reportSchool['ReportSchool']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reportSchool['ReportSchool']['id']), null, __('Are you sure you want to delete # %s?', $reportSchool['ReportSchool']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Report School'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
