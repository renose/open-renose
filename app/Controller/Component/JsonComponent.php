<?php

/*
 * AjaxComponent.php
 * 
 * Copyright (c) 2011-2012 open reNose team <info at renose.de>.
 * Simon Wörner, Patrick Hafner and Daniel Greiner.
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
 * 
 */

class JsonComponent extends Component
{

    public $components = array('RequestHandler');
    
    public static $status = array(
        -1 => 'error',
        -2 => 'exception',
        10 => 'successfull',
        11 => 'change successfull',
        12 => 'create successfull',
        13 => 'delete successfull',
    );
    public static $errors = array(
        -1 => 'general error',
        -10 => 'save failed',
        -11 => 'change failed',
        -12 => 'create failed',
        -13 => 'delete failed',
        -20 => 'input missing',
        -21 => 'input invalid',
        -30 => 'not found',
        42 => 'yep, that\'s the answer',
        1337 => 'master ü is calling',
    );

    public function response($data, $status_code = 1)
    {
        $this->RequestHandler->setContent('json', 'application/json');

        $response = JsonComponent::get_response($data, $status_code);
        die(json_encode($response));
    }

    public function error($message, $error_code = -1, $data = null)
    {
        $this->RequestHandler->setContent('json', 'application/json');

        $response = JsonComponent::get_error($message, $error_code, $data);
        die(json_encode($response));
    }
    
    public static function get_response($data, $status_code = 1)
    {
        return array(
            'message' => null,
            'status' => array(
                'code' => $status_code,
                'msg' => isset(JsonComponent::$status[$status_code]) ? JsonComponent::$status[$status_code] : null
            ),
            'error' => null,
            'data' => $data,
            'timestamp' => time()
        );
    }
    
    public static function get_error($message, $error_code = -1, $data = null)
    {
        return array(
            'message' => $message,
            'status' => array(
                'code' => -1,
                'msg' => isset(JsonComponent::$status[-1]) ? JsonComponent::$status[-1] : null
            ),
            'error' => array(
                'code' => $error_code,
                'msg' => isset(JsonComponent::$errors[$error_code]) ? JsonComponent::$errors[$error_code] : null
            ),
            'data' => $data,
            'timestamp' => time()
        );
    }

}