<?php
    //Vorname bekannt
    if($Profile['Profile']['first_name'])
    {
        //Setze Vornamen
        $name = $Profile['Profile']['first_name'];

        //Nachname auch bekannt? - setzen
        if($Profile['Profile']['last_name'])
            $name .= ' ' . $Profile['Profile']['last_name'];
    }
    //Vorname nicht bekannt aber Nachname?
    else if($Profile['Profile']['last_name'])
    {
        //Setze Nachname mit Herr/Frau
        $name .= ' ' . $Profile['Profile']['last_name'];
    }
    //Beides Unbekannt
    else
    {
        //Registriter User
        if($User['User']['id'])
            $name = 'Ninja';
        //Gast
        else
            $name = 'Gast';
    }
?>
<?php
    //Job angegeben
    if($Profile['Job']['id'])
    {
        //Setze Job Name
        $job = $Profile['Job']['name'];

        //Fachrichtung bekannt? - setzen
        if($Profile['Job']['specialization'])
            $job .= ' - ' . $Profile['Job']['specialization'];
    }
    else
        $job = 'Uelzer';
?>

<p>
    Hallo <b><?php echo $name; ?></b>.
</p>
<p>
    Wie läuft es mit deiner Ausbildung zum <i><?php echo $job; ?></i>?
</p>

<br/><br/>
<?php
    debug($User);
    debug($Profile);
?>