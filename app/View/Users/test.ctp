<?php
/*
 * test.ctp
 *
 * Copyright (c) 2011 open reNose team <info at renose.de>.
 * Simon Wörner and Patrick Hafner.
 *
 * This file is part of open reNose.
 *
 * open reNose is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * open reNose is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with open reNose.  If not, see <http ://www.gnu.org/licenses/>.
 */
?>

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
    pr($this->Session->read());
    pr($User);
    pr($Profile);