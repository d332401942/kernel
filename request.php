<?php

class Request extends RequestCoreLib
{
    
    public function apiRequest($parameters)
    {
        $defFunc = config::VIEW_FUNC;
        $viewStr = empty($parameters[0]) ? strtolower(Config::VIEW_DOLDER) : strtolower($parameters[0]);
        if (strtolower($parameters[1]) != 'json')
        {
            throw new BusinessException('不支持请求的格式',  BusinessException::EXCEPTION_CODE_TYPE);
        }
        $className = null;
        UrlCoreLib::$viewClass = $this->getViewClass($viewStr, $className);
        LogVendorLib::start($className, $defFunc);
        $data = UrlCoreLib::$viewClass->$defFunc();
        echo json_encode($data);
        LogVendorLib::end($className, $defFunc);
    }
}
