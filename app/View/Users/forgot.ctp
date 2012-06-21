<h1>Passwort vergessen</h1>

<div class="row">
    <div class="span3">&nbsp;</div>
    <div class="span6 well" style="margin-top: 20px">
        <p>Falls du dein Passwort vergessen haben solltest, gebe hier bitte die E-Mail Adresse ein, die du bei der Registrierung angegeben hast.
        <br />Wir werden dir umgehend eine Mail senden, in der du das Passwort ändern kannst.</p>
        <?php
            echo $this->Form->create('User');

            echo $this->Form->input('email', array('label' => 'Deine E-Mail Adresse'));

            echo $this->Form->submit('Zurücksetzen');
            echo $this->Form->end();
        ?>
    </div>
    <div class="span3">&nbsp;</div>
</div>