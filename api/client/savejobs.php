<?php

class SavejobsClientApi extends BaseApi
{

	/**
	 * 当队列达到多少时不再写入
	 */
	const LIST_MAX_LEN = 100000;

	public function index()
	{
		$key = 'savedbtocache';
		if (empty($_GET['key']) or $_GET['key'] != $key) 
		{
			throw new BusinessException('错误的key');
		}
		$business = M('ClientBusiness');
		$maxLen = $business->getListLen();
		if ($maxLen >= self::LIST_MAX_LEN)
		{
			return false;
		}
		$models = $business->selectJobs();
		if ($models)
		{
			foreach ($models as $model)
			{
				$pageCount = $model->pagecount;
				for ($page = 1; $page <= $pageCount; $page++)
				{
					$s = ($page - 1) * 36;
					$url = $model->url . '&s=' . $s;
					$data = array();
					$data['taskid'] = $model->id;
					$data['goodtypename'] = $model->goodtypename;
					$data['url'] = $url;
					$data['page'] = $page;
					$data['scriptname'] = $model->scriptname;
					$business->addJob($data);
				}
			}
		}
		return true;
	}

	public function index1()
	{
		$file = './jobs';
		$handle = fopen($file, 'r');
		$array = array();
		while ($line = fgets($handle))
		{
			$model = new ClientJobsDataModel();
			$info = explode(',', $line);
			if (count($info) != 4) 
			{
				break;
			}
			$model->goodtypename = trim($info[1]);
			$model->url = trim($info[2]);
			$model->pagecount = (int)$info[3];
			$array[] = $model;
			$data = new ClientJobsData();
			$data->add($model);
		}
	}
}
