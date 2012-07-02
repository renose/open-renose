<?= $this->Html->css($this->Html->url($templatePath.'css/ihk.css', true)); ?>
<table>
    <tr>
        <td width="100px"><?= $this->Html->image($this->Html->url($templatePath.'img/ihk_logo_grey.png', true), array('id' => 'ihk-logo')); ?></td>
        <td><h1 id="ihk-name"><?= $user['Profile']['assigned_board_of_trade'] ?></h1></td>
    </tr>
</table>
<hr>
<h2 class="aligncenter" style="font-size: 16pt;line-height: 3px;">Berichtsheft</h2>
<p class="aligncenter">(Ausbildungsnachweis für die Berufsausbildung, wöchentliche Berichte)</p>
<br>
<table class="overview-table" border="0" width="85.5%">
    <tr>
        <td width="50%">Name, Vorname</td>
        <td colspan="2"><?php if($user['Profile']['last_name'] && $user['Profile']['first_name']) echo "{$user['Profile']['last_name']}, {$user['Profile']['first_name']}"; ?>
        </td>
    </tr>
    <tr>
        <td>Geburtsort</td>
        <td><?= $user['Profile']['birthplace'] ?></td>
        <td>Geburtsdatum: <?= $this->Time->format('d.m.Y', $user['Profile']['birthday']) ?></td>
    </tr>
    <tr>
        <td>Anschrift</td>
        <td colspan="2"><?php if($user['Profile']['street'] && $user['Profile']['zip_code'] && $user['Profile']['city']) echo $user['Profile']['street'].', '.$user['Profile']['zip_code'].' '.$user['Profile']['city'] ?></td>
    </tr>
    <tr>
        <td>Ausbildungsberuf (nach Berufsbild)</td>
        <td colspan="2"><?= $user['Job']['name'] ?></td>
    </tr>
    <tr>
        <td>Ausbildungsfirma</td>
        <td colspan="2"><?= $user['Profile']['company'] ?></td>
    </tr>
    <tr>
        <td>Geschäftszweig</td>
        <td colspan="2"><?= $user['Profile']['branch'] ?></td>
    </tr>
    <tr>
        <td>Vertragliche Ausbildungszeit vom</td>
        <td><?= $this->Time->format('d.m.Y', $user['Profile']['start_training_period']) ?></td>
        <td>bis <?= $this->Time->format('d.m.Y', $user['Profile']['end_training_period']) ?></td>
    </tr>
    <tr>
        <td>Berufsausbildungsvertrag abgeschlossen am</td>
        <td colspan="2"><?= $this->Time->format('d.m.Y', $user['Profile']['contract_signed']) ?></td>
    </tr>
    <tr>
        <td colspan="2">Eingetragen in das Verzeichnis der Berufsausbildungsverhältnisse der IHK am</td>
        <td><?= $this->Time->format('d.m.Y', $user['Profile']['contract_registered']) ?></td>
    </tr>
</table>

<table border="0" width="100%" class="overview-table">
    <tr>
        <td class="no-border">&nbsp;</td>
    </tr>
    <tr>
        <td class="no-border"><strong>Kurzbericht über Schulbildung und vorangegangene berufliche Tätigkeiten vor Antritt der Ausbildung</strong></td>
    </tr>
    <?php
        $past = explode("\n", $user['Profile']['past']);
        for($i=0;$i<=8;$i++) {
            echo '<tr><td>';
            if(isset($past[$i])) {
                echo $past[$i];
            } else {
                echo '';
            }
            echo '</td></tr>';
        }
    ?>
</table>

<table border="0" width="100%" class="overview-table">
    <tr>
        <td class="no-border">&nbsp;</td>
    </tr>
    <tr>
        <td class="no-border"><strong>Gesetzlicher Vertreter des Auszubildenden</strong></td>
    </tr>
    <tr>
        <td>Name: </td>
    </tr>
    <tr>
        <td>Beruf: </td>
    </tr>
    <tr>
        <td>Anschrift: </td>
    </tr>
    <tr>
        <td>Unterschrift der Eltern bzw. der gesetzlichen Vertreter: </td>
    </tr>
</table>
<p></p>
<p>Anmerkung: Das Berufsbild gibt Aufschluss über den Umfang der Fertigkeiten und Kenntnisse, die in der Ausbildungszeit vermittelt werden. Es kann von der IHK bezogen werden und ist dem Ausdruck des Berichtsheftes beizufügen.</p>