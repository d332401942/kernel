<?php

class ClientJobsDataModel extends BaseDataModel
{

	public $goodtypename;

	public $url;

	public $pagecount;

	public $scriptname;

	public function __construct()
	{
		parent::__construct();
		$this->setTableName('client_jobs');
	}
}
