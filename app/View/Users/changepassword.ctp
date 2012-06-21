<h1>Passwort ändern</h1>

<div class="row">
    <div class="span3">&nbsp;</div>
    <div class="span6 well" style="margin-top: 20px">
        <p>Bitte geben Sie ein neues Passwort ein</p><br />
        <?php
            echo $this->Form->create('User', array(
                'inputDefaults' => array(
                    'div' => 'control-group',
                    'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
                )
            ));
            echo $this->Form->input('id');
            echo '<p>E-Mail Adresse: '.$email;
            echo $this->Form->input('password', array('label' => 'Neues Passwort'));
            echo $this->Form->input('password_confirm', array('label' => 'Neues Passwort bestätigen', 'type' => 'password'));
            echo $this->Form->submit('Passwort ändern');
            echo $this->Form->end();
        ?>
    </div>
    <div class="span3">&nbsp;</div>
</div>