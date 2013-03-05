<?php

class ClientCacheData extends CacheDbLib
{

	const JOBS_KEY = 'client_jobs_key';

	public function getJob()
	{
		$data = $this->getRedis()->lPop(self::JOBS_KEY);
		return $data;
	}

	public function getListLen()
	{
		$num = $this->getRedis()->lLen(self::JOBS_KEY);
		return $num;
	}

	public function addJob($data)
	{
		//$this->getRedis()->flushDB();exit;
		$string = json_encode($data);
		$this->getRedis()->rPush(self::JOBS_KEY, $string);
	}
}
