<?php

class GetjobClientApi extends BaseApi
{
    
    public function index()
    {
        if (empty($_GET['key']) || $_GET['key'] != Config::CLIENT_API_KEY)
        {
            throw new BusinessException('错误的key');
        }
		$redis = new RedisCoreLib();
		$data = $redis->lPop('jobsOne');
		
		$redis->rPush('jobsOne', $data);
		$arr = json_decode($data, true);
		if ($arr)
		{
			$arr['hastask'] = true;
			$arr['scriptname'] = Config::CLIENT_SCRIPT_NAME;
		}
		else
		{
			$arr['hastask'] = false;
		}
		return $arr;
    }
}
