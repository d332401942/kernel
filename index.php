<?php
define('APP_DIR', '');
define('APP_ROOT','');
define('APP_URL','');

include '../feng/main.php';
include './request.php';
$mainClass = new Main();
$regulation = array(
    '/(.*?)\.(json|xml)/' => array('apiRequest', 1, 2),
);
try
{
    $mainClass->run($regulation);
}
catch (BusinessException $e)
{
    $code = $e->getCode();
    $msg = $e->getMessage();
    header("HTTP/1.0 501 BusinessException");
    echo json_encode(array('message' => $msg, 'code' => $code));
}
catch (Exception $e)
{
    header("HTTP/1.0 404 Not Found");
    if (Config::FIRE_DEBUG)
    {
        echo $e;
    }
}
