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
                else if($soan==1){//neu chi co 1 an mot phuong trinh
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
        $somu=1;
        $p=[];
        $p_luythua=[];
        $luythuaduoc=-1;
        if(isset($_POST['sobac'])){//thay doi so an, so phuong trinh
            $sobac=$_POST['sobac'];
            for($i=0;$i<$sobac;$i++){//khoi tao ma tran a va b
                $p[$i]=[];
                for($j=0;$j<$sobac;$j++){
                    $p[$i][$j]='';
                }
            }
            if(isset($_POST['p'])){//gan dau vao tu ngoai
                $p=$_POST['p'];
                $somu=$_POST['somu'];
                for($i=0;$i<$sobac;$i++){
                    for($j=0;$j<$sobac;$j++){
                        if($p[$i][$j]!=''){
                            $p[$i][$j]= $this->calculate_string($p[$i][$j]); 
                        }else{
                            $p[$i][$j]=0;
                        }
                    }
                }
                if($somu==-1&&$sobac>1){
                    if($this->matrandoclap($p, $sobac)==true){
                        $p_luythua=  $this->matrannghichdao($p, $sobac);
                        $luythuaduoc=1;
                    }else{
                        $luythuaduoc=0;
                    }
                }else{
                    if($somu==0&&$this->matran0($p, $sobac)==TRUE){
                        $luythuaduoc=0;
                    }  else {
                        $p_luythua=$this->luythua($p, $sobac, $somu);
                        $luythuaduoc=1;
                    }
                    
                }
            }
           
        }
        return $this->render('matran',[
            'sobac'=>$sobac,
            'somu'=>$somu,
            'p'=> $p,
            'p_luythua'=>$p_luythua,
            'luythuaduoc'=>$luythuaduoc,
        ]);
    }
    public function luythua($matran, $sobac,$somu){
        if($sobac>1){
            $ketqua=$matran;
            if($somu==0){//neu la luy thua 0 se ra ma tran don vi
                if($this->matran0($matran, $sobac)==  FALSE){
                    for($i=0;$i<$sobac;$i++){
                        for($j=0;$j<$sobac;$j++){
                            if($i==$j){
                                $ketqua[$i][$j]=1;
                            }else{
                                $ketqua[$i][$j]=0;
                            }
                        }
                    }
                    return $ketqua;
                }else{
                    return $matran;
                }
            }
            if($somu==1){//neu luy thua 1 se chinh no
                return $ketqua;
            }
            if($somu>1){
                for($i=1;$i<$somu;$i++){
                    $ketqua=  $this->nhanhaimatran($ketqua, $sobac, $sobac, $matran, $sobac);
                }
                return $ketqua;
            }
            
        }else if($sobac==1){
            $matran[0][0]=  pow( $matran[0][0], $somu);
            return $matran;
        }
    }
    public function matran0($matran, $sobac){
        for($i=0;$i<$sobac;$i++){
            for($j=0;$j<$sobac;$j++){
                if($matran[$i][$j]!=0){
                    return FALSE;
                }
            }
        }
        return true;
    }
    public function matrandoclap($matran, $sobac){
        if($sobac>1){
            $khanghich=0;
            $a_giai=$matran;
            for($t=1;$t<$sobac;$t++){
                if($a_giai[$t-1][$t-1]==0){//hoan doi hang co phan tu troi khac 0
                    $khanghich=0;
                    for($i=$t;$i<$sobac;$i++){//tim tu hang t tro di co phan tu cung cot t-1 khac 0 la duoc
                        if($a_giai[$i][$t-1]!=0){//hoan doi hang i va hang t-1
                            $khanghich=1;
                            //hoan doi a
                            for($j=0;$j<$sobac;$j++){
                                $hoandoi=$a_giai[$t-1][$j];
                                $a_giai[$t-1][$j]=$a_giai[$i][$j];
                                $a_giai[$i][$j]=$hoandoi;
                            }
                            break;
                        }
                    }
                    if($khanghich==0){//he vo nghiem
                        return FALSE;
                    }
                }
                $khanghich=1;
                $duongcheo=$a_giai[$t-1][$t-1];
                for($i=$t;$i<$sobac;$i++){
                    $u=$a_giai[$i][$t-1];
                    for($j=$t-1;$j<$sobac;$j++){//cong thuc duon cheo troi
                        $a_giai[$i][$j]=$a_giai[$i][$j]-$a_giai[$t-1][$j]*$u/$duongcheo;
                    }
                }
            }
            for($i=0;$i<$sobac;$i++){
                if($a_giai[$i][$i]==0){
                    return FALSE;
                }
            }
            
            return TRUE;
        }
        return FALSE;
    }
    public function matrandonvi($sobac){
        $matrandonvi=[];
        for($i=0;$i<$sobac;$i++){
            $matrandonvi[$i]=[];
            for($j=0;$j<$sobac;$j++){
                if($i==$j){
                    $matrandonvi[$i][$j]=1;
                }else{
                    $matrandonvi[$i][$j]=0;
                }
            }
        }
        return $matrandonvi;
    }

    public function matrannghichdao($matran, $sobac){
        if($sobac>1){
            $khanghich=0;
            $a_giai=$matran;
            $matrannghichdao=  $this->matrandonvi($sobac);
            
            for($t=1;$t<$sobac;$t++){
                
                if($a_giai[$t-1][$t-1]==0){//hoan doi hang co phan tu troi khac 0
                    $khanghich=0;
                    for($i=$t;$i<$sobac;$i++){//tim tu hang t tro di co phan tu cung cot t-1 khac 0 la duoc
                        if($a_giai[$i][$t-1]!=0){//hoan doi hang i va hang t-1
                            $khanghich=1;
                            for($j=0;$j<$sobac;$j++){
                                //hoan doi a
                                $hoandoi=$a_giai[$t-1][$j];
                                $a_giai[$t-1][$j]=$a_giai[$i][$j];
                                $a_giai[$i][$j]=$hoandoi;
                                //hoan doi ma tran nghich dao
                                $hoandoi=$matrannghichdao[$t-1][$j];
                                $matrannghichdao[$t-1][$j]=$matrannghichdao[$i][$j];
                                $matrannghichdao[$i][$j]=$hoandoi;
                            }
                            
                            break;
                        }
                    }
                    if($khanghich==0){//he vo nghiem
                        return FALSE;
                    }
                }
                $khanghich=1;
                $duongcheo=$a_giai[$t-1][$t-1];
                for($i=$t;$i<$sobac;$i++){
                    $u=$a_giai[$i][$t-1];
                    
                    for($j=$t-1;$j<$sobac;$j++){//cong thuc duon cheo troi
                        $a_giai[$i][$j]=$a_giai[$i][$j]-$a_giai[$t-1][$j]*$u/$duongcheo;
                        $matrannghichdao[$i][$j]=$matrannghichdao[$i][$j]-$matrannghichdao[$t-1][$j]*$u/$duongcheo;
                    }
                }
            }
            for($i=0;$i<$sobac;$i++){
                if($a_giai[$i][$i]==0){
                    return FALSE;
                }
            }
            for($t=$sobac-2;$t>=0;$t--){
                $duongcheo=$a_giai[$t+1][$t+1];
                for($i=$t;$i>=0;$i--){//tat ca cac hang tu $t tro ve truoc
                    $u=$a_giai[$i][$t+1];//a dau dong hang i
                    for($j=$t+1;$j>=0;$j--){//cong thuc duon cheo troi
                        $a_giai[$i][$j]=$a_giai[$i][$j]-$a_giai[$t+1][$j]*$u/$duongcheo;
                        $matrannghichdao[$i][$j]=$matrannghichdao[$i][$j]-$matrannghichdao[$t+1][$j]*$u/$duongcheo;
                    }
                }
            }
            for($i=0;$i<$sobac;$i++){
                $duongcheo=$a_giai[$i][$i];
                for($j=0;$j<$sobac;$j++){
                    $a_giai[$i][$j]=$a_giai[$i][$j]/$duongcheo;
                    $matrannghichdao[$i][$j]=$matrannghichdao[$i][$j]/$duongcheo;
                }
            }
            return $matrannghichdao;
        }
        return FALSE;
    }

    public function nhanhaimatran($matran1, $n1, $m1, $matran2, $m2){
        $ketqua=[];
        for($i=0;$i<$n1;$i++){
            $ketqua[$i]=[];
        }
        for($i=0;$i<$n1;$i++){
            for($j=0;$j<$m2;$j++){
                $ketqua[$i][$j]=0;
                for($t=0;$t<$m1;$t++){
                    $ketqua[$i][$j]+=$matran1[$i][$t]*$matran2[$t][$j];
                }
            }
        }
        return $ketqua;
    }
}
