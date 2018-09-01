<?php
namespace app\datamachine\controller;
use app\datamachine\model\NodeManagement as NM;
use think\Controller;

class StockSys extends controller
{
    //添加库存页面
    public function add_stock_page()
    {   
        $this -> assign('realName', session('realName'));
        $this -> assign('userID', session('userID'));
    	return $this->fetch();
    }


}
