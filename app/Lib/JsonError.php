<?php

class JsonError
{
    public static function handleError($code, $description, $file = null, $line = null, $context = null)
    {        
        $response = JsonComponent::get_error("Internal Error", -2, array(
            'code' => $code,
            'description' => $description,
            'file' => $file,
            'line' => $line,
            'context' => $context,
        ));
        die(json_encode($response));
    }
    
    public static function handleException($exception)
    {
        $response = JsonComponent::get_error('Internal Exception', -2, $exception);
        die(json_encode($response));
    }
}