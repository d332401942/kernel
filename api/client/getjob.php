<?php

class GetjobClientApi extends BaseApi
{
    
    public function index()
    {
        if (empty($_GET['key']) || $_GET['key'] != Config::CLIENT_API_KEY)
        {
            throw new BusinessException('错误的key');
        }
		$num = 1;
		if (!empty($_GET['num']))
		{
			$num = $_GET['num'];
		}
		$business = M('ClientBusiness');
		$arr = array();
		for ($i = 0; $i < $num; $i++)
		{
			$data = $business->getJob();
			if ($data)
			{
				$value = json_decode($data, true);
				array_push($arr, $value);
			}
		}
		$lastData = array();
		if ($arr)
		{
			$lastData['hastask'] = true;
			$lastData['tasklist'] = $arr;
		}
		else
		{
			$lastData['hastask'] = false;
		}
		return $lastData;
    }
}
