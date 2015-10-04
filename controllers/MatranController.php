<?php

namespace app\controllers;

class MatranController extends \yii\web\Controller
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
        $soan=0;
        $conghiem=-1;
        $a=[];
        $b=[];
        $x=[];
        if(isset($_POST['soan'])){//thay doi so an, so phuong trinh
            $soan=$_POST['soan'];
            
            for($i=0;$i<$soan;$i++){//khoi tao ma tran a va b
                $a[$i]=[];
                for($j=0;$j<$soan;$j++){
                    $a[$i][$j]='';
                }
                $b[$i]='';
                $x[$i]='';
            }
            if(isset($_POST['b'])){
               
                $b=$_POST['b'];//gan gia tri dau vao
                $a=$_POST['a'];
                for($i=0;$i<$soan;$i++){
                    for($j=0;$j<$soan;$j++){
                        if($a[$i][$j]!=''){
                            $a[$i][$j]= $this->calculate_string($a[$i][$j]); 
                        }else{
                            $a[$i][$j]=0;
                        }
                    }
                    if($b[$i]!=''){
                        $b[$i]= $this->calculate_string($b[$i]); 
                    }else{
                        $b[$i]=0;
                    }
                }
                
                $b_giai=$b;
                $a_giai=$a;
                $conghiem=0;//kiem tra tinh co nghiem
                if($soan>1){
                    for($t=1;$t<$soan;$t++){//thuc hien giai he
                        if($a_giai[$t-1][$t-1]==0){//hoan doi hang co phan tu troi khac 0
                            $conghiem=0;
                            for($i=$t;$i<$soan;$i++){//tim tu hang t tro di co phan tu cung cot t-1 khac 0 la duoc
                                if($a_giai[$i][$t-1]!=0){//hoan doi hang i va hang t-1
                                    $conghiem=1;
                                    //hoan doi a
                                    for($j=0;$j<$soan;$j++){
                                        $hoandoi=$a_giai[$t-1][$j];
                                        $a_giai[$t-1][$j]=$a_giai[$i][$j];
                                        $a_giai[$i][$j]=$hoandoi;
                                    }
                                    //hoan doi b
                                    $hoandoi=$b_giai[$t-1];
                                    $b_giai[$t-1]=$b_giai[$i];
                                    $b_giai[$i]=$hoandoi;
                                    break;
                                }
                            }
                            if($conghiem==0){//he vo nghiem
                                break;
                            }
                        }
                        $conghiem=1;
                        $duongcheo=$a_giai[$t-1][$t-1];
                        for($i=$t;$i<$soan;$i++){
                            $u=$a_giai[$i][$t-1];
                            for($j=$t-1;$j<$soan;$j++){//cong thuc duon cheo troi
                                $a_giai[$i][$j]=$a_giai[$i][$j]-$a_giai[$t-1][$j]*$u/$duongcheo;
                            }
                             $b_giai[$i]=$b_giai[$i]-$u*$b_giai[$t-1]/$duongcheo;
                        }
                    }
                    for($i=0;$i<$soan;$i++){
                        if($a_giai[$i][$i]==0){
                            if($b_giai[$i]==0){
                                $conghiem=2;
                            }else{
                                $conghiem=0;
                                break;
                            }
                           
                        }
                    }
                    if($conghiem==1){
                        for($i=$soan-1;$i>=0;$i--){//tim nghiem
                            $tongax=0;
                            for($j=$i+1;$j<$soan;$j++){
                                $tongax+=$a_giai[$i][$j]*$x[$j];
                            }
                            $x[$i]=($b_giai[$i]-$tongax)/$a_giai[$i][$i];
                        }

                    }
                }
                else if($soan==1){
                    if($a[0][0]==0){
                        $conghiem=0;
                    }else{
                        $conghiem=1;
                        $x[0]=$b[0]/$a[0][0];
                    }
                }
            }
        }
        
        return $this->render('index',[
            'soan'=>$soan,
            'a'=>$a,
            'b'=>$b,
            'x'=>$x,
            'conghiem'=>$conghiem
        ]);
    }
    public function actionMatran(){
        $sobac=0;
        return $this->render('matran',[
            'sobac'=>$sobac,
        ]);
    }

}
