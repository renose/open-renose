<?php
$this->Html->addCrumb('Seiten');
$this->Html->addCrumb('FAQ', array('action' => 'display', 'faq'));
?>
<h1>
    <?php echo $this->Html->image('icons/help.png'); ?>
    FAQ - Häufig gestellte Fragen
</h1>
<br/>

<p>
    Meine Berichtsnummer oder das Datum wird falsch angezigt.
    <ul><li>
        Bitte prüfe ob du in deinem Profil alle Pflichtfelder ausgefüllt hast.<br/>
        (Pflichtfelder werden rot hinterlegt)
    </li></ul>
</p>
<br/>

<p>
    Welchen Browser benötige ich?
    <ul><li>
        Wir unterstützen die folgenden Browser:<br/>
        <ul>
            <li><?= $this->Html->image('icons/chrome.png'); ?> Google Chrome</li>
            <li><?= $this->Html->image('icons/firefox.png'); ?> Firefox</li>
            <li><?= $this->Html->image('icons/safari.png'); ?> Safari</li>
        </ul>
    </li></ul>
    <ul><li>
        Wir arbeiten an der Unterstützung von:
        <ul>
            <li><?= $this->Html->image('icons/ie.png'); ?> Internet Explorer 9</li>
            <li><?= $this->Html->image('icons/opera.png'); ?> Opera</li>
            <li><?= $this->Html->image('icons/safari.png'); ?> Safari</li>
        </ul>
    </li></ul>
    <ul><li>
        Nicht unterstützt wird:
        <ul>
            <li><?= $this->Html->image('icons/ie.png'); ?> Internet Explorer 5, 6, 7 und 8</li>
        </ul>
    </li></ul>
</p>
<br/>

<p>
    Ich habe einen Fehler entdeckt oder möchte einen Wunsch oder Kritik äußern.
    <ul><li>
        Du kannst dich direkt bei uns mit einer Email an <i>info@renose.de</i> melden.<br/>
        Wir werden versuchen deine Mail so schnell wie möglich zu beantworten.
    </li></ul>
</p>
<br/>

<p>
    Der Quellcode ist scheiße, ich würde es besser machen!
    <ul><li>
        Dann schreib ihn selber ;)
    </li></ul>
</p>