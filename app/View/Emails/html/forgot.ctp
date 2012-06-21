<p>Hallo <?= $data['Profile']['first_name'] ?><br/>
Sie haben sich erfolgreich bei <i>opren reNose</i> (http://www.renose.de) registriert.</p>

<p>Bitte klicke auf folgenden Link, um dein Passwort zu ändern:<br/>
    <?php echo $this->Html->link(
        $this->Html->url(array('controller' => 'users', 'action' => 'activate', $data['User']['email'], $newAuthKey), true)); ?></p>

<p>Sie haben sich mit folgender EMail angemeldet: <br/>
    <?php echo $data['User']['email']; ?></p>

<p>Mit freundlichen Grüßen,<br/>
    Ihr <i>open reNose</i> Team</p>

<br/>
<p>P.S.: Sollten Sie sich nicht registriert haben, ignorieren Sie diese Email einfach.</p>