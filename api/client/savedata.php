<?php

class SavedataClientApi extends BaseApi
{
    
    public function index()
    {
		//P($_POST);
		if (empty($_POST))
		{
			$json = file_get_contents("php://input");
		}
		$_POST = json_decode($json, true);
		$handle = fopen('demo.txt', 'a');
		$data = include './jsondata.php';
		$info = json_decode($data, true);
		if (empty($info['data']))
		{
			return false;	
		}
		$business = new ClientBusiness();
		foreach ($info['data'] as $arr)
		{
			$model = new JsonDataDataModel();
			$model->GoodTypeName = $info['goodtypename'];
			$model->CreateTime = time();
			$model->IsOk = $arr['isok'];
			$model->FromSite = $arr['from'];
			$model->GoodName = $arr['name'];
			$model->Content = json_encode($arr);
			$business->addJsonData($model);
		}
		return true;
    }
}
