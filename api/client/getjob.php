<?php

class GetjobClientApi extends BaseApi
{
    
    public function index()
    {
        if (empty($_GET['key']) || $_GET['key'] != Config::CLIENT_API_KEY)
        {
            throw new BusinessException('错误的key');
        }
        return array('id' => 10, 'url' => 'http:www.baidu.com');
    }
}
