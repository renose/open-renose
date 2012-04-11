<?php
/* 
 * register.ctp
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
<p>Hallo,<br/>
Sie haben sich erfolgreich bei <i>opren reNose</i> (http://www.renose.de) registriert.</p>

<p>Bitte aktivieren Sie ihren Account über folgenden Link:<br/>
    <?php echo $this->Html->link(
        $this->Html->url(array('controller' => 'users', 'action' => 'activate', $User['User']['email'], $User['User']['activationkey']), true)); ?></p>

<p>Sie haben sich mit folgender EMail angemeldet: <br/>
    <?php echo $User['User']['email']; ?></p>

<p>Mit freundlichen Grüßen,<br/>
    Ihr <i>open reNose</i> Team</p>

<br/>
<p>P.S.: Sollten Sie sich nicht registriert haben, ignorieren Sie diese Email einfach.</p>