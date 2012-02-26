<?php
/* 
 * welcome.ctp
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

<h1>Herzlich Willkommen <?php echo $this->requestAction('/users/get_name'); ?>!</h1>

<?php if(!$User['User']['is_active']) { ?>
<p>Dein Account ist z.Z. noch nicht aktiviert.
Bitte prüfe dein Email-Postfach und aktiviere dein Konto.
</p>
<?php } ?>

<?php if(!$Profile['Profile']) { ?>
<p>Du hast noch kein Profile angelegt.
Bitte leg dir ein Profil an damit wir dich auch mit deinem Namen ansprechen können
und dich deine Freunde finden können.
</p>
<?php } ?>