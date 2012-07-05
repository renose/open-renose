<tr>
    <td class="school-subject"><?= $subject ?></td>
    
    <td class="school-topic edit-container" data-id="<?= $id ?>" data-subject="<?= $subject ?>">
        <div class="edit-textbox" data-exists="<?= $data != null ? 'true' : 'false' ?>"><?= $data != null ? $data : '' ?></div>
        <?= $this->Html->image('icons/delete.png', array('class' => 'edit-delete', 'alt' => 'Dieses Thema löschen')); ?>
    </td>
</tr>