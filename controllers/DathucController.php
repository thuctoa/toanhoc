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
        $miennghiem=[];
        $nghiem=[];
        $gtt=0;
        if(isset($_POST['sobac'])){//thay doi so an, so phuong trinh
            $sobac=$_POST['sobac'];
            for($i=0;$i<=$sobac;$i++){
                $a[$i]='';
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
                if($a[$sobac]==0){
                    $conghiem=-10;
                }
                if($conghiem!=-10)
                {
                    if(isset($_POST['tinh'])){
                        $gtt=  $this->giaitrifx($a, $sobac, $_POST['tinh']);
                    }
                    if($sobac==1){
                        $nghiem[0]=-1*$a[0]/$a[1];
                        $conghiem=25;
                    }
                    if($sobac==2){
                        $nghiem=  $this->giaiphuongtrinhbachai($a);
                        $conghiem=50;
                    }
                    if($sobac>2){
                        $conghiem=100;//khac -10 va -1
                        $a_daoham=  $this->tinhdaohamncap($a, $sobac);//tinh dao ham

                        //dao nguoc lai de khu de quy
                        $a_tmp=[];
                        foreach ($a_daoham as $val){
                            array_push($a_tmp, array_pop($a_daoham));
                        }
                        $a_daoham=$a_tmp;
                        array_push($a_daoham, $a);
                        //giai phuong trinh bac hai
                        $nghiem=  $this->giaiphuongtrinhbachai($a_daoham[1]);
                        $nghiem=  $this->xapxepgiam($nghiem);



                        //tim nghiem phuong trinh bac 3
                        $bactinh=3;
                        while($bactinh<=$sobac){
                            $nghiem=  $this->xapxepgiam($nghiem);
                            $miennghiem=  $this->miennghiem($a_daoham[$bactinh-1],$bactinh);
                            $taokhoangphany=  $this->tronhaimanggiamdan($nghiem, $miennghiem);
                            $sonpl=count($taokhoangphany)-1;
                            //tim cac khoang phan ly nghiem de lap
                            $khoangphanly=[];
                            for($i=0;$i<$sonpl;$i++){
                                if( $this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $taokhoangphany[$i])
                                    *$this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $taokhoangphany[$i+1])<=0){
                                    $phanly[0]=$taokhoangphany[$i];
                                    $phanly[1]=$taokhoangphany[$i+1];
                                    array_push($khoangphanly, $phanly);
                                }
                            }

                            $nghiem=[];
                            if(count($khoangphanly)>0){//neu co khoang phan ly thi lap
                              //  $saiso=0.00000001;
                                foreach ($khoangphanly as $val){
                                    $center=($val[0]+$val[1])/2;
                                    if( $this->giaitrifx($a_daoham[$bactinh-3], $bactinh-2, $center)>=0
                                        &&$this->giaitrifx($a_daoham[$bactinh-2], $bactinh-1, $center)>=0){
                                        $x0=$val[0];
                                        $d=$val[1];
                                    }
                                    if( $this->giaitrifx($a_daoham[$bactinh-3], $bactinh-2, $center)<=0
                                        &&$this->giaitrifx($a_daoham[$bactinh-2], $bactinh-1, $center)<=0){
                                        $x0=$val[0];
                                        $d=$val[1];
                                    }
                                    if( $this->giaitrifx($a_daoham[$bactinh-3], $bactinh-2, $center)<=0
                                        &&$this->giaitrifx($a_daoham[$bactinh-2], $bactinh-1, $center)>=0){
                                        $x0=$val[1];
                                        $d=$val[0];
                                    }
                                    if( $this->giaitrifx($a_daoham[$bactinh-3], $bactinh-2, $center)>=0
                                        &&$this->giaitrifx($a_daoham[$bactinh-2], $bactinh-1, $center)<=0){
                                        $x0=$val[1];
                                        $d=$val[0];
                                    }
                                    if($this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $d)-
                                                $this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $x0)!=0){
                                        for($i=0;$i<500;$i++){
                                            if($this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $d)-
                                                        $this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $x0)==0){
                                                $x1=$x0;
                                                break;
                                            }else{
                                                $x1=$x0- ($d-$x0)*  $this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $x0)/
                                                        ($this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $d)-
                                                            $this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $x0));
                                                if($this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $x1)==0){
                                                    break;
                                                }
    //                                            if(abs($x1-$x0)<$saiso){
    //                                                break;
    //                                            }
                                            }
                                            $x0=$x1;
                                        }
                                    }
                                    array_push($nghiem, $x1);//ta co duoc nghiem va cho lap lai
                                }
                            }
                            $bactinh++;
                        }
                    }
                    //print_r($khoangphanly);die;
                }
                
            }   
        }
        
        return $this->render('index',[
            'sobac'=>$sobac,
            'conghiem'=>$conghiem,
            'a'=>$a,
            'a_daoham'=>$a_daoham,
            'miennghiem'=>$miennghiem,
            'nghiem'=>$nghiem,
            'gtt'=>$gtt,
        ]);
    }
    public function giaiphuongtrinhbachai($a){//he so A= a[2], B=a[1] va C =a[0] 
        $A=$a[2];
        $B=$a[1];
        $C=$a[0];
        $delta= $B*$B - 4 * $A * $C;
        $nghiem=[];
        if($delta>0){
            $x1=(-1* $B - sqrt($delta) )/(2*$A);
            $x2=(-1* $B + sqrt($delta) )/(2*$A);
            array_push($nghiem, $x1);
            array_push($nghiem, $x2);
        }else if($delta==0){
             array_push($nghiem, (-1* $B)/(2*$A));
        }
        return $nghiem;
    }
    public function khoangphanly($taokhoangphanly, $fx){
        
    }
    public function giaitrifx($fx,$sobac,$c){
        $b=$fx[$sobac];
        for($i=1;$i<=$sobac;$i++){
            $b=$fx[$sobac-$i]+$b*$c;
        }
        return $b;
    }

    public function tronhaimanggiamdan($a, $b){
        $c=[];
        while(count($a)>0&&count($b)>0){
            $x1=  end($a);
            $x2=  end($b);
            if($x1<$x2){
                array_push($c, $x1);
                array_pop($a);
            }else{
                array_push($c, $x2);
                array_pop($b);
            }
        }
        while (count($a)>0){
            array_push($c, array_pop($a));
        }
        while (count($b)>0){
            array_push($c, array_pop($b));
        }
        return $c;
    }

    public function xapxepgiam($array){
        $n=count($array);
        for($i=0;$i<$n-1;$i++){
            for($j=$i+1;$j<$n;$j++){
                if($array[$i]<$array[$j]){
                    $tmp=$array[$i];
                    $array[$i]=$array[$j];
                    $array[$j]=$tmp;
                }
            }
        }
        return $array;
    }

    public function miennghiem($a, $sobac){
        $miennghiem=[];
        $a_chuan=[];
        $a_chuan=  $this->phuongtrinhchuan($a, $sobac);
        //tim can tren
        $cantren=  $this->timcantren($a_chuan, $sobac);
        array_push($miennghiem, $cantren);
        //tim can duoi
        //thuc hien doi x thanh -x de giai voi da thuc co nghiem doi
        for($i=0;$i<=$sobac;$i++){
            $a_chuan[$i]=$a_chuan[$i]*pow(-1,$i);
        }
        $a_chuan=  $this->phuongtrinhchuan($a_chuan, $sobac);
        //luc nay da thuc co nghiem la -x se co can tren, ta bien thanh 
        //can duoi cua da thuc co nghiem la x
        $canduoi= -1* $this->timcantren($a_chuan, $sobac); 
        array_push($miennghiem, $canduoi);
        return $miennghiem;
    }

    public function phuongtrinhchuan($a, $sobac){//phuong trinh co he so a lon 0
        $a_chuan=[];
        if($a[$sobac]>0){
            $a_chuan=$a;
        }else{
            for($i=0;$i<=$sobac;$i++){
                $a_chuan[$i]=-1*$a[$i];
            }
        }
        return $a_chuan;
    }
    public function timcantren($a_chuan, $sobac){
        $cantren=0;
        $B=-1;
        $K=-1;
        for($i=0;$i<$sobac;$i++){
            if($a_chuan[$i]<0){
                if($B<  abs($a_chuan[$i])){
                    $B=abs($a_chuan[$i]);
                }
                $K=$i;
            }
        }
        if($K!=-1)
        {
            $K=$sobac-$K;
            $cantren=1+pow($B/$a_chuan[$sobac], 1/$K);
        }else{
            $cantren=0;
        }
        return $cantren;
    }

    public function tinhdaohamncap($a, $sobac){//tinh dao ham tu cap 1 den cap sobac - 1
        $a_daoham=[];
        $a_luudaoham=$a;
        $bacdaoham=$sobac-1;
        while($bacdaoham>0){
            $a_daohamcap=[];
            for($i=0;$i<=$bacdaoham;$i++){
                $a_daohamcap[$i]=$a_luudaoham[$i+1]*($i+1);
            }
            $a_luudaoham=$a_daohamcap;
            array_push($a_daoham, $a_daohamcap);
            $bacdaoham--;
        };
        return $a_daoham;
    }

    public function actionNhanhaidathuc()
    {
        return $this->render('nhanhaidathuc',[
            
        ]);
    }
    public function actionChiadachodathuc()
    {
        return $this->render('chiadachodathuc',[
            
        ]);
    }
    
    public function actionDothi()
    {
        return $this->render('dothi');
    }
}
