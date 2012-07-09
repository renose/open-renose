<h2>
    <?= $this->Html->image($icon); ?>
    <?= $header ?>
</h2>

<div class="edit-container editbox" data-id="<?= $id ?>" data-field="<?= $field ?>">
<?php if($data) : ?>
    <div class="edit-textbox" data-exists="true"><?= $data ?></div>
<?php else: ?>
    <div class="edit-textbox" data-exists="false"></div>
<?php
    endif;
    echo $this->Html->image('icons/delete.png', array('class' => 'edit-delete', 'alt' => 'löschen'));
?>
    
    <div style="clear: both;"></div>
</div>
<br/>