<?php

class SavedataClientApi extends BaseApi
{
    
    public function index()
    {
		$json = file_get_contents("php://input");
		file_put_contents('demo.txt', $json);
		$info = json_decode($json, true);
		
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
