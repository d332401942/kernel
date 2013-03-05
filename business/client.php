<?php

class ClientBusiness extends BaseBusiness
{

	public function getListLen()
	{
		$dataClass = M('ClientJobsData');
		$num = $dataClass->getListLen();
		return $num;
	}

	public function selectJobs()
	{
		$dataClass = M('ClientJobsData');
		$models = $dataClass->selectJobs();
		return $models;
	}

	public function getJob()
	{
		$dataClass = M('ClientJobsData');
		$data = $dataClass->getJob();
		return $data;
	}

	public function addJob($data)
	{
		$dataClass = M('ClientJobsData');
		$dataClass->addJob($data);
	}

}
