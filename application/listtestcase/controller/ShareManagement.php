<?php

namespace app\listtestcase\controller;

use app\listtestcase\model\ShareManagement as SM;
use think\Loader;
use think\Controller;

class ShareManagement extends controller
{
    /**
     * @return mixed
     * 分享管理页面
     */
    public function index()
    {
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        return $this->fetch();
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 测试用例预览页面
     */
    public function list_tc_page()
    {
        $testPlanId = $_GET['testPlanId'];
        $testModuleId = $_GET['testModuleId'];
        $this->assign('realName', session('realName'));
        $this->assign('userID', session('userID'));
        $this->assign('testPlanId', $testPlanId);
        $this->assign('testModuleId', $testModuleId);
        $sm = new SM;
        $this->assign('shareName', $sm->getShareName($testPlanId, $testModuleId));
        return $this->fetch();
    }

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得分享列表数据
     */
    public function getShareList()
    {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $keyWords = $_GET['key'];
        $sm = new SM;
        echo $sm->getShareList($limit, $offset, $keyWords);
    }

    /**
     * 按测试计划id和模块id获得测试用例列表数据
     */
    public function getTestcaseList()
    {
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];
        $testPlanId = $_GET['testPlanId'];
        $testModuleId = $_GET['testModuleId'];
        $sm = new SM;
        echo $sm->getTestCaseList($limit, $offset, $testPlanId, $testModuleId);
    }

    /**
     * @return array
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     * 批量设置用例评审通过
     */
    public function batchReviewPass()
    {
        $testPlanId = trim($_POST['testPlanId']);
        $testModuleId = trim($_POST['testModuleId']);
        $sm = new SM;
        $result = $sm->batchReviewPass($testPlanId,$testModuleId);
        if ($result >= 1) {
            return ['status' => 1, 'info' => '已批量设置评审状态为通过！'];
        } else {
            return ['status' => 0, 'info' => '批量操作失败，请重试！'];
        }

    }

    /**
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 按测试计划id和模块id导出测试用例
     */
    public function exportListTestCase()
    {
        $testPlanId = $_GET['testPlanId'];
        $testModuleId = $_GET['testModuleId'];
        $sm = new SM;
        $data = $sm->getExcelTCData($testPlanId, $testModuleId);

        Loader::import('PHPExcel.Classes.PHPExcel');
        Loader::import('PHPExcel.Classes.PHPExcel.IOFactory.PHPExcel_IOFactory');
        $PHPExcel = new \PHPExcel();
        $PHPSheet = $PHPExcel->getActiveSheet();
        $PHPSheet->setTitle("export_share_tc"); //给当前活动sheet设置名称
        //设置单元格样式
        $PHPSheet->getColumnDimension('B')->setWidth(60);
        $PHPSheet->getColumnDimension('C')->setWidth(40);
        $PHPSheet->getColumnDimension('D')->setWidth(40);
        $PHPSheet->getColumnDimension('E')->setWidth(40);
        $PHPSheet->getColumnDimension('F')->setWidth(10);
        $PHPSheet->getColumnDimension('G')->setWidth(20);

        $PHPSheet->getStyle('B:E')->getAlignment()->setWrapText(true);
        $PHPSheet->getStyle('A1:G1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $PHPSheet->getRowDimension(1)->setRowHeight(35);

        $PHPSheet->setCellValue("A1", "ID")->setCellValue("B1", "测试用例标题")->setCellValue("C1", "前置条件")->setCellValue("D1", "操作步骤")->setCellValue("E1", "预期结果")->setCellValue("F1", "创建人")->setCellValue("G1", "创建时间");//表格数据
        $index = 2;
        foreach ($data as $row) {
            $PHPSheet->setCellValue("A" . $index, $row['id'])->setCellValue("B" . $index, $row['tc_name'])->setCellValue("C" . $index, $row['per_descript'])->setCellValue("D" . $index, $row['step_descript'])->setCellValue("E" . $index, $row['expect_descript'])->setCellValue("F" . $index, $row['creator_name'])->setCellValue("G" . $index, $row['create_date']);//表格数据
            $index++;
        }
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, "Excel2007");
        header('Content-Disposition: attachment;filename="export_share_tc.xlsx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成文件
    }
}
