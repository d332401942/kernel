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
				$pageCount = $model->PageCount;
				for ($page = 1; $page <= $pageCount; $page++)
				{
					$s = ($page - 1) * 36;
					$url = $model->Url . '&s=' . $s;
					$data = array();
					$data['taskid'] = $model->Id;
					$data['goodtypename'] = $model->GoodTypeName;
					$data['url'] = $url;
					$data['page'] = $page;
					$data['scriptname'] = $model->ScriptName;
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
			$model->GoodTypeName = trim($info[1]);
			$model->Url = trim($info[2]);
			$model->PageCount = (int)$info[3];
			$array[] = $model;
			$data = new ClientJobsData();
			$data->add($model);
		}
	}
}
