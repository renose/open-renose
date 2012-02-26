<?php
/*
 * userinfo.ctp
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
    if($this->Session->check('Auth.User'))
    {
        $name = $this->requestAction('/users/get_name');
        echo "Hallo <b>$name</b>. ";
        echo $this->Html->link('Ausloggen', '/users/logout');
    }
    else
    {
        echo 'Hallo <b>Gast</b>. Bitte ';
        echo $this->Html->link('registrieren', '/users/register') . ' oder ';
        echo $this->Html->link('einloggen', '/users/login') . '.';
    }
?>