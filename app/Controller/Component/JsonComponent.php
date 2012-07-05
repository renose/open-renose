<?php

class JsonComponent extends Component
{

    public $components = array('RequestHandler');

    public static $status = array(
        -1 => 'error',
        -2 => 'exception',
        10 => 'successfull',
        11 => 'change successful',
        12 => 'create successful',
        13 => 'delete successful',
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