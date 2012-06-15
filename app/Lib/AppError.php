<?php

class AppError
{
    public static function handleError($code, $description, $file = null, $line = null, $context = null)
    {
        $errorHandler = AppError::getErrorHandler();
        $errorHandler::handleError($code, $description, $file = null, $line = null, $context = null);
        
        //ErrorHandler::handleError($code, $description, $file, $line, $context);
    }
    
    public static function handleException($exception)
    {
        $errorHandler = AppError::getErrorHandler();
        $errorHandler::handleException($exception);
        
        //ErrorHandler::handleException($exception);
    }
    
    private static function getErrorHandler()
    {
        $errorHandler = Configure::read('Exception.handler');
        $errorHandler = explode('::', $errorHandler);
        
        if($errorHandler[0] == 'AppError')
            $errorHandler[0] = 'ErrorHandler';
        
        return $errorHandler[0];
    }
}