<?= $this->Html->css($this->Html->url($templatePath.'css/ihk.css', true)); ?>
<table class="detailTable spacer">
    <tr>
        <td><?= $detail['title'] ?></td>
    </tr>
    <tr>
        <td class="detailText"><?= nl2br($detail['text']) ?></td>
    </tr>
</table>
<br />