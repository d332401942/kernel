<?php

class ClientJobsData extends BaseData
{

	/**
	 * 间隔多少时间更新队列
	 */
	const LIMIT_CACHE_TIME = 86400;

	public function selectJobs()
	{
		$query = array();
		//查询1天类没有加入队列的前5条URL
		$query['cachetime'] = array('<=' => time() - self::LIMIT_CACHE_TIME);
		$this->setLimit(array(0, 5));
		$this->where($query);
		$data = $this->findAll();
		//更新他们的入队时间
		$checkedIds = null;
		if ($data) 
		{
			foreach ($data as $model)
			{
				$checkedIds .= ',' .$model->id;
			}
			$checkedIds = ltrim($checkedIds, ',');
			$sql = 'update client_jobs set cachetime = '. time() . ' where id in (' . $checkedIds . ')';
			$this->exec($sql);
		}
		return $data;
	}

	public function getListLen()
	{
		$cache = M('ClientCacheData');
		$num = $cache->getListLen();
		return $num;
	}

	public function getJob()
	{
		$cache = M('ClientCacheData');
		$data = $cache->getJob();
		return $data;
	}

	public function addJob($data)
	{
		$cache = M('ClientCacheData');
		$data = $cache->addJob($data);
	}
}
