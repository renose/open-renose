<?php
/*
 * controller_list.php
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

class ControllerListComponent extends Component
{
    public function get($groupPermissions = null)
    {
        $controllerClasses = App::objects('controller');

        foreach($controllerClasses as $controller)
        {
            if ($controller != 'App')
            {
                App::import('Controller', $controller);
                $className = $controller . 'Controller';
                $actions = get_class_methods($className);

                foreach($actions as $k => $v)
                {
                    if ($v{0} == '_')
                        unset($actions[$k]);
                }

                $parentActions = get_class_methods('AppController');
                $actions = array_diff($actions, $parentActions);

                if($groupPermissions != null)
                {
                    $actions_access = array();
                    foreach($actions as $action)
                    {
                        $type = '0';

                        foreach($groupPermissions as $groupPermission)
                        {
                            if(strcasecmp($groupPermission['controller'], $controller) == 0 &&
                               strcasecmp($groupPermission['action'], $action) == 0)
                            {
                                if($groupPermission['type'] == 1)
                                    $type = '+';
                                else
                                    $type = '-';

                                break;
                            }
                        }

                        $actions_access[$action] = $type;
                    }

                    $controllers[$controller] = $actions_access;
                }
                else
                    $controllers[$controller] = $actions;
            }
        }

        return $controllers;
    }
}