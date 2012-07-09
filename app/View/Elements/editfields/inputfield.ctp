<div class="input">
    <?php if(isset($name)): ?>
        <label for="<?= $field ?>"><?= $name ?></label>
        <br/>
    <?php endif; ?>
    
    <?php
        $type = isset($type) ? "type='$type'" : '';        
        echo "<input id='$field' class='inputfield edit-container' $type data-id='$id' data-field='$field' value='$data'/>";
    ?>
</div>