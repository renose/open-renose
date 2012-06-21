<p>Hallo,<br/>
Sie haben die "Passwort vergessen" Funktion auf open reNose aufgerufen.<br />

<p>Klicken Sie auf folgenden Link, um Ihr Passwort zu ändern:<br/>
    <?php echo $this->Html->link(
        $this->Html->url(array('controller' => 'users', 'action' => 'changepassword', $data['User']['email'], $newAuthKey), true)); ?></p>

<p>Sie haben sich mit folgender E-Mail Adresse angemeldet: <br/>
    <?php echo $data['User']['email']; ?></p>

<p>Mit freundlichen Grüßen,<br/>
    Ihr <i>open reNose</i> Team</p>

<br/>
<p>P.S.: Sollten Sie ihr Passwort nicht vergessen haben, ignorieren Sie diese Email einfach.</p>