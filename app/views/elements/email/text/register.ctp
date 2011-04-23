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
Hallo,

Sie haben sich erfolgreich bei opren reNose (http://www.renose.de) registriert.

Bitte aktivieren Sie ihren Account über folgenden Link:
    <?php echo $html->link(
        $html->url(array('controller' => 'users', 'action' => 'activate', $User['User']['email'], $User['User']['activationkey']), true)); ?>


Sie haben sich mit folgender EMail angemeldet:
    <?php echo $User['User']['email']; ?>


Mit freundlichen Grüßen,
    Ihr open reNose Team


P.S.: Sollten Sie sich nicht registriert haben, ignorieren Sie diese Email einfach.