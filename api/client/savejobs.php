<?php

class SavejobsClientApi extends BaseApi
{

	public function index()
	{
		$file = '/home/wwwroot/jobs.txt';
		$handle = fopen($file,'r');
		$i = 1;
		$redis = new RedisCoreLib();
		//$redis->flushAll();exit;
		while($line = fgets($handle))
		{
			/**
			header('Content-Type: text/html; charset=GBK');
			$content = file_get_contents($url);
			if (preg_match('/J_pagination_form.*?<\/form>/is', $content, $arr))
			{
				$page = array_pop($arr);
				$page = strip_tags($page);
				print_r($page);
				$i++;
			}
			if ($i > 2)
			{
				return;
			}
			*/
			$num = 50;
			$i = 1;
			$pageSize = 36;
			for ($i; $i<= $num; $i++) 
			{
				$info = explode(',', $line);
				$data = array();
				$data['tastid'] = $info[0];
				$data['goodtypename'] = $info[1];
				$url = trim($info[2]);
					
				$s = ($i - 1) * $pageSize;
				$url = $url .'&s=' . $s;
				$data['url'] = $url;
				$data['page'] = $i;
				$data['scriptid'] = '';
				$redis->rPush('jobsOne', json_encode($data));
			}
		}
	}
}
