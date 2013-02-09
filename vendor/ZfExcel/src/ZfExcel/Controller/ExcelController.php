<?php
namespace ZfExcel\Controller;


use \PHPExcel;
use \PHPExcel_IOFactory;
use ZfExcel\Form\ExcelForm;
use ZfExcel\Model\Excel ;
use ZfExcel\Model\ExcelTable ;
use Zend\Validator\File\Extension;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\File\Size;
use Zend\Session\Container;

class ExcelController extends AbstractActionController
{
	public $excelTable;

    public function indexAction()
    {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser/login');
        }

		 return new ViewModel(array(
            'excel' => $this->getExcelTable()->fetchAll()       ));
    }

    public function addAction()
    {
       $form = new ExcelForm();

       $request = $this->getRequest();
             if ($request->isPost()) {
                    $excel = new Excel();
                    $form->setInputFilter($excel->getInputFilter());

                    $nonFile = $request->getPost()->toArray();
                    $File    = $this->params()->fromFiles('path');
                    $data = array_merge(
                        $nonFile, //POST
                        array('path'=> $File['name']) //FILE...
                    );
                    //set data post and file ...
                    $form->setData($data);

	              	if ($form->isValid()) {
		                $size = new Size(array('max'=>4000000,'min'=>1000)); //minimum bytes filesize
		                $extension = new Extension(array('xls','xlsx'));
		                $adapter = new \Zend\File\Transfer\Adapter\Http();
		                $adapter->setValidators(array($size,$extension), $File['name']);

		                if (!$adapter->isValid()){
		                    $dataError = $adapter->getMessages();
		                    $error = array();
		                    foreach($dataError as $key=>$row)
		                    {
		                        $error[] = $row;
		                    }

		                    $form->setMessages(array('path'=>$error ));

		                } else {

		                    $adapter->setDestination(dirname(__DIR__).'/tmp');

		                    if ($adapter->receive($File['name'])) {
		                        $excel->exchangeArray($form->getData());
		                        $excel->path = dirname(__DIR__).'\\'.'tmp'.'\\'.$excel->path;
								$lastid=$this->getExcelTable()->saveExcel($excel);

		                        return $this->redirect()->toRoute('zfexcel/read',array( 'controller' => 'zfexcel',
																                        'action' =>  'read',
																                        'id' => $lastid,
		                            												 	));
		                    }
		                }
	            	}
        	}
        return array('form' => $form);
        //return new ViewModel();
    }

    public function ReadAction()
    {
        $request = $this->getRequest();

        if ($request->isGet()) {

            $id = $this->getEvent()->getRouteMatch()->getParam('id');
            $file=$this->getExcelTable()->getExcel($id);
        }
        $objPHPExcel = PHPExcel_IOFactory::load("$file->path");

		$excel_array = $objPHPExcel->getActiveSheet()->toArray() ;
		echo " <pre>";
	    print_r($excel_array[0]);

	    echo " </pre>";

		return array('excel_array' => $excel_array);
    }
    private function inserttodb()
    {


    }
    public function getExcelTable()
    {
        if (!$this->excelTable) {
            $sm = $this->getServiceLocator();
            $this->excelTable = $sm->get('ZfExcel\Model\ExcelTable');
        }

        return $this->excelTable;
    }

}