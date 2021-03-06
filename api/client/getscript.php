<?php

class GetscriptClientApi extends BaseApi
{

	public function index()
	{
		if (empty($_GET['key']) || $_GET['key'] != Config::CLIENT_API_KEY)
        {
            throw new BusinessException('错误的key');
        }
		if (empty($_GET['scriptname']))
		{
			throw new BusinessException('脚本名称不能为空');
		}
		$name = trim($_GET['scriptname']);
		$file = './resource/script/' . $name;
		if (!file_exists($file))
		{
			echo $file;
			throw new BusinessException('文件不存在');
		}
		$content = file_get_contents($file);
		return array('content' => $content);
	}
}
