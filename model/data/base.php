<?php

class BaseDataModel extends ModelCoreLib
{

    public $Id;

    public function __construct()
    {
        $this->setPrimaryKey('Id');
        parent::__construct();
    }
}
