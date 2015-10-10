<?php

namespace app\controllers;

class DathucController extends \yii\web\Controller
{
    public function beforeAction($action) {
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
    }
    function calculate_string( $mathString )    {
        $mathString = trim($mathString);     // trim white spaces
        $mathString = ereg_replace ('[^0-9\+-\*\/\(\) ]', '', $mathString);    // remove any non-numbers chars; exception for math operators

        $compute = create_function("", "return (" . $mathString . ");" );
        return 0 + $compute();
    }
    public function actionIndex()
    {
        $sobac='';
        $conghiem=-1;
        $a=[];
        $a_daoham=[];
        if(isset($_POST['sobac'])){//thay doi so an, so phuong trinh
            $sobac=$_POST['sobac'];
            for($i=0;$i<=$sobac;$i++){
                $a[$i]='';
            }
            $bacdaoham=$sobac-1;
            for($i=0;$i<=$bacdaoham;$i++){
                $a_daoham[$i]='';
            }
            if(isset($_POST['a'])){
                $a=$_POST['a'];
                for($i=0;$i<=$sobac;$i++){//lam dep a
                     if($a[$i]!=''){
                        $a[$i]= $this->calculate_string($a[$i]); 
                    }else{
                        $a[$i]=0;
                    }
                }
                
                for($i=0;$i<=$bacdaoham;$i++){
                    $a_daoham[$i]=$a[$i+1]*($i+1);
                }
            }   
        }
        
        return $this->render('index',[
            'sobac'=>$sobac,
            'conghiem'=>$conghiem,
            'a'=>$a,
            'a_daoham'=>$a_daoham,
        ]);
    }
    public function actionDothi()
    {
        return $this->render('dothi');
    }
}
