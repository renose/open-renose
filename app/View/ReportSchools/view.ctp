<div class="reportSchools view">
<h2><?php  echo __('Report School');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reportSchool['ReportSchool']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Report'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reportSchool['Report']['id'], array('controller' => 'reports', 'action' => 'view', $reportSchool['Report']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($reportSchool['ReportSchool']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
			<?php echo h($reportSchool['ReportSchool']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($reportSchool['ReportSchool']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($reportSchool['ReportSchool']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Report School'), array('action' => 'edit', $reportSchool['ReportSchool']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Report School'), array('action' => 'delete', $reportSchool['ReportSchool']['id']), null, __('Are you sure you want to delete # %s?', $reportSchool['ReportSchool']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Report Schools'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report School'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
