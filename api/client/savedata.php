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
		$str = json_encode($_POST). '--' . date('Y-m-d H:i:s') . "\r\n";
		fwrite($handle, $str);
		return $_POST;
    }
}
