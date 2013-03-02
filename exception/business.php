<?php

class BusinessException extends BusinessExceptionLib
{
    
    /**
     * 请求数据类型不正确
     */
    const EXCEPTION_CODE_TYPE = 6000;
    
    public function __construct($message = '', $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}