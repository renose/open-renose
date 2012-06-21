<h1>Passwort vergessen</h1>

<div class="row">
    <div class="span3">&nbsp;</div>
    <div class="span6 well" style="margin-top: 20px">
        <p>Falls Sie ihr Passwort vergessen haben sollten, geben Sie hier bitte die E-Mail Adresse ein, die bei der Registrierung verwendet wurde.
        <br />Wir werden Ihnen umgehend eine Mail senden, in der Sie das Passwort ändern können.</p>
        <?php
            echo $this->Form->create('User');

            echo $this->Form->input('email', array('label' => 'Deine E-Mail Adresse'));

            echo $this->Form->submit('Zurücksetzen');
            echo $this->Form->end();
        ?>
    </div>
    <div class="span3">&nbsp;</div>
</div>