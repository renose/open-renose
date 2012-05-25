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
    public $Controller = null;
    
    public $status = array(
        -1 => 'error',
        10 => 'successfull',
        11 => 'change successfull',
        12 => 'create successfull',
        13 => 'delete successfull',
    );
    public $errors = array(
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
    
    public function initialize($controller) {
        $this->Controller = $controller;
    }

    public function response($data, $status_code = 1)
    {
        $this->RequestHandler->setContent('json', 'application/json');

        $response = array(
            'message' => null,
            'status' => array(
                'code' => $status_code,
                'msg' => isset($this->status[$status_code]) ? $this->status[$status_code] : null
            ),
            'error' => null,
            'data' => $data,
            'timestamp' => time()
        );
        
        echo json_encode($response);
        exit();
    }

    public function error($message, $error_code = -1, $data = null)
    {
        $this->RequestHandler->setContent('json', 'application/json');

        $response = array(
            'message' => $message,
            'status' => -1,
            'error' => array(
                'code' => $error_code,
                'msg' => isset($this->errors[$error_code]) ? $this->errors[$error_code] : null
            ),
            'data' => $data,
            'timestamp' => time()
        );
        
        echo json_encode($response);
        exit();
    }

}