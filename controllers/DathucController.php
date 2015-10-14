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
        $a_giai=[];
        $bac_giai=0;
        $conghiem0=-1;
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
                if($sobac>16){
                    $conghiem=-20;
                }
                if($conghiem!=-10&&$conghiem!=-20)
                {
                    if(isset($_POST['tinh'])){
                        $gtt=  $this->giaitrifx($a, $sobac, $_POST['tinh']);
                    }
                    $a_giai=$a;
                    $bac_giai=$sobac;
                    while ($this->giaitrifx($a_giai, $bac_giai, 0)==0){
                        for($i=0;$i<$bac_giai;$i++){
                            $a_giai[$i]=$a_giai[$i+1];
                        }
                        $bac_giai--;
                        $conghiem0=1;
                    }
                    
                    if($bac_giai==1){
                        $nghiem[0]=-1*$a_giai[0]/$a_giai[1];
                        $conghiem=25;
                    }
                    if($bac_giai==2){
                        $nghiem=  $this->giaiphuongtrinhbachai($a_giai);
                        $conghiem=50;
                    }
                    if($bac_giai>2){
                        $conghiem=100;//khac -10 va -1
                        
                        $a_daoham=  $this->tinhdaohamncap($a_giai, $bac_giai);//tinh dao ham

                        //dao nguoc lai de khu de quy
                        $a_tmp=[];
                        foreach ($a_daoham as $val){
                            array_push($a_tmp, array_pop($a_daoham));
                        }
                        $a_daoham=$a_tmp;
                        array_push($a_daoham, $a_giai);
                        //giai phuong trinh bac hai
                        $nghiem=  $this->giaiphuongtrinhbachai($a_daoham[1]);
                        $nghiem=  $this->xapxepgiam($nghiem);
                        


                        //tim nghiem phuong trinh bac 3
                        $bactinh=3;
                        while($bactinh<=$bac_giai){
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
                                $saiso=0.0000001;
                                foreach ($khoangphanly as $val){
                                    $center=($val[0]+$val[1])/2;
                                    $f2=$this->giaitrifx($a_daoham[$bactinh-3], $bactinh-2, $center);
                                    $f1=$this->giaitrifx($a_daoham[$bactinh-2], $bactinh-1, $center);
                                    if( $f2>=0&&$f1>=0){
                                        $x0=$val[0];
                                        $d=$val[1];
                                    }
                                    if( $f2<=0&&$f1<=0){
                                        $x0=$val[0];
                                        $d=$val[1];
                                    }
                                    if( $f2<=0&&$f1>=0){
                                        $x0=$val[1];
                                        $d=$val[0];
                                    }
                                    if( $f2>=0&&$f1<=0){
                                        $x0=$val[1];
                                        $d=$val[0];
                                    }
                                    //phuong phap day cung de lap
                                    $fx0=$this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $x0);
                                    $fxd=$this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $d);
                                    $x1=$x0;
                                    if( $fxd - $fx0!=0){
                                        
                                        do{
                                            $fx0=$this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $x0);
                                            $fxd=$this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $d);
                                            
                                            if($fxd - $fx0==0){
                                                $x1=$x0;
                                                break;
                                            }else{
                                                $x1=$x0- ($d-$x0)* $fx0/
                                                        ($fxd - $fx0);
                                                if($this->giaitrifx($a_daoham[$bactinh-1], $bactinh, $x1)==0){
                                                    break;
                                                }
                                                if(abs($x1-$x0)<$saiso){
                                                    break;
                                                }
                                            }
                                            $x0=$x1;
                                        }while(true);
                                    }
                                    array_push($nghiem, $x1);//ta co duoc nghiem va cho lap lai
                                }
                            }
                            $nghiem=  $this->nghiemphanbiet($nghiem);
                            $bactinh++;
                        }
                    }
                    //print_r($khoangphanly);die;
                }
                
            }   
        }
        if($conghiem0==1){
            array_push($nghiem, 0);
        }
        $nghiem=  $this->xapxeptang($nghiem);
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
    public function nghiemphanbiet($nghiem){//loai bot gia tri trung
        $nghiemdep=[];
        foreach ($nghiem as $val){
            if(!in_array($val, $nghiemdep)){
                array_push($nghiemdep, $val);
            }
            
        }
        return $nghiemdep;
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
    public function xapxeptang($array){
        $n=count($array);
        for($i=0;$i<$n-1;$i++){
            for($j=$i+1;$j<$n;$j++){
                if($array[$i]>$array[$j]){
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
        $n1='';
        $n2='';
        $a=[];
        $b=[];
        $ab=[];
        $n12=[];
        $ladathuc=-1;
        if(isset($_POST['n1'])){
            $n1=$_POST['n1'];
            $n2=$_POST['n2'];
            $n12=$n1+$n2;
            for($i=0;$i<=$n1;$i++){
                $a[$i]='';
            }
            for($i=0;$i<=$n2;$i++){
                $b[$i]='';
            }
        }
        if(isset($_POST['a'])){
            $b=$_POST['b'];//gan gia tri dau vao
            $a=$_POST['a'];
            for($i=0;$i<=$n1;$i++){
                if($a[$i]!=''){
                    $a[$i]= $this->calculate_string($a[$i]); 
                }else{
                    $a[$i]=0;
                }
            }
            for($i=0;$i<=$n2;$i++){
                if($b[$i]!=''){
                    $b[$i]= $this->calculate_string($b[$i]); 
                }else{
                    $b[$i]=0;
                }
            }
            if($a[$n1]==0){
                if($b[$n2]==0){
                    $ladathuc=2;
                }else{
                    $ladathuc=1;
                }
            }else if($b[$n2]==0){
                    $ladathuc=3;
            }  else {
                $ladathuc=4;//tat ca da hop le
            }
            if($ladathuc==4){
                $ab=  $this->nhanhaidathuc($a, $n1, $b, $n2);
            }
            
        }
        return $this->render('nhanhaidathuc',[
            'n1'=>$n1,
            'n2'=>$n2,
            'n12'=>$n12,
            'a'=>$a,
            'b'=>$b,
            'ab'=>$ab,
            'ladathuc'=>$ladathuc
        ]);
    }
    public function actionLuythuadathuc(){
        $n='';
        $n_luythua='';
        $a=[];
        $somu=1;
        $ladathuc=-1;
        $a_luythua=[];
        if(isset($_POST['n'])){
            $n=$_POST['n'];
            for($i=0;$i<=$n;$i++){
                $a[$i]='';
            }
        }
        if(isset($_POST['a'])){
            $a=$_POST['a'];
            $somu=$_POST['somu'];
            for($i=0;$i<=$n;$i++){
                if($a[$i]!=''){
                    $a[$i]= $this->calculate_string($a[$i]); 
                }else{
                    $a[$i]=0;
                }
            }
            
            if($a[$n]==0){
                $ladathuc=1;
                
            } else if($somu<1){
                $ladathuc=2;
            }else {
                $ladathuc=4;//tat ca da hop le
            }
            if($ladathuc==4){
                if($somu==1){
                    $a_luythua=$a;
                    $n_luythua=$n;
                }else{
                    $a_luythua=$a;
                    $n_luythua=$n;
                    for($i=1;$i<$somu;$i++){
                        $a_luythua=  $this->nhanhaidathuc($a_luythua, $n_luythua, $a, $n);
                        $n_luythua+=$n;
                    }
                }
            }
            
        }
        return $this->render('luythuadathuc',[
            'n'=>$n,
            'a'=>$a,
            'ladathuc'=>$ladathuc,
            'somu'=>$somu,
            'a_luythua'=>$a_luythua,
            'n_luythua'=>$n_luythua,
        ]);
    }

    public function nhanhaidathuc($a, $na, $b, $nb){
        $ab=[];
        $nab=$na+$nb;
        for($i=0;$i<=$nab;$i++){
            $ab[$i]=0;
            for($j=0;$j<=$na;$j++){
                for($k=0;$k<=$nb;$k++){
                    if($j+$k==$i){
                        $ab[$i]+=$a[$j]*$b[$k];
                    }
                }
            }
        }
        return $ab;
    }
    
    public function chiahaidathuc($dathucbichia, $nbichia, $dathucchia, $nchia){
        if($nbichia>=$nchia){
            $thuong=[];
            $nthuong=$nbichia-$nchia;
            for($i=0;$i<$nthuong;$i++){
                $thuong[$i]=0;
            }
            $ntrunggian=0;
            $trungian=[];
            while($nbichia>=$nchia){
                $thuongtrung=[];
                $hieu=$nbichia-$nchia;
                $thuong[$hieu]=$dathucbichia[$nbichia]/$dathucchia[$nchia];
                for($i=0;$i<$hieu;$i++){
                    $thuongtrung[$i]=0;
                }
                $thuongtrung[$hieu]=$thuong[$nbichia-$nchia];
                $trungian=  $this->nhanhaidathuc($dathucchia, $nchia, $thuongtrung, $nbichia-$nchia);
                $ntrunggian=  $this->baccuadathuc($trungian);
                $dathucbichia=  $this->hieucuahaidathuc($dathucbichia, $nbichia, $trungian, $ntrunggian);
                $nbichia=  $this->baccuadathuc($dathucbichia);
            }
            
            return $thuong;
        }
    }
    public function chiahaidathucdu($dathucbichia, $nbichia, $dathucchia, $nchia){
        if($nbichia>=$nchia){
            $thuong=[];
            $nthuong=$nbichia-$nchia;
            for($i=0;$i<$nthuong;$i++){
                $thuong[$i]=0;
            }
            $ntrunggian=0;
            $trungian=[];
            while($nbichia>=$nchia){
                $thuongtrung=[];
                $hieu=$nbichia-$nchia;
                $thuong[$hieu]=$dathucbichia[$nbichia]/$dathucchia[$nchia];
                for($i=0;$i<$hieu;$i++){
                    $thuongtrung[$i]=0;
                }
                $thuongtrung[$hieu]=$thuong[$nbichia-$nchia];
                $trungian=  $this->nhanhaidathuc($dathucchia, $nchia, $thuongtrung, $nbichia-$nchia);
                $ntrunggian=  $this->baccuadathuc($trungian);
                $dathucbichia=  $this->hieucuahaidathuc($dathucbichia, $nbichia, $trungian, $ntrunggian);
                $nbichia=  $this->baccuadathuc($dathucbichia);
            }
            
            return $dathucbichia;
        }
    }
    public function tichcuadathucvoimotso($a, $na, $so){
        $ketqua=[];
        for($i=0;$i<=$na;$i++){
            $ketqua[$i]=$a[$i]*$so;
        }
        return $ketqua;
    }
    public function tongcuahaidathuc($a, $na, $b, $nb){
        if($na>=$nb){
            $tong=[];
            for($i=0;$i<=$nb;$i++){
                $tong[$i]=$a[$i]
                        +$b[$i];
            }
            for(;$i<=$na;$i++){
                $tong[$i]=$a[$i];
            }
            return $tong;
        }  else {
            return $this->tongcuahaidathuc($b, $nb, $a, $na);
        }
    }
    public function hieucuahaidathuc($a, $na, $b, $nb){
        $trub=  $this->tichcuadathucvoimotso($b, $nb, -1);
        return $this->tongcuahaidathuc($a, $na, $trub, $nb);
    }
    public function baccuadathuc($a){
        $bac=0;
        foreach ($a as $key=>$val){
            if($val!=0){
                if($bac<$key){
                    $bac=$key;
                }
            }
        }
        return $bac;
    }

    public function actionChiadachodathuc()
    {
        $n1='';
        $n2='';
        $a=[];
        $b=[];
        $phanchia=[];
        $phandu=[];
        $nphanchia='';
        $nphandu='';
        $ladathuc=-1;
        if(isset($_POST['n1'])){
            $n1=$_POST['n1'];
            $n2=$_POST['n2'];
            for($i=0;$i<=$n1;$i++){
                $a[$i]='';
            }
            for($i=0;$i<=$n2;$i++){
                $b[$i]='';
            }
        }
        if(isset($_POST['a'])){
            $b=$_POST['b'];//gan gia tri dau vao
            $a=$_POST['a'];
            for($i=0;$i<=$n1;$i++){
                if($a[$i]!=''){
                    $a[$i]= $this->calculate_string($a[$i]); 
                }else{
                    $a[$i]=0;
                }
            }
            for($i=0;$i<=$n2;$i++){
                if($b[$i]!=''){
                    $b[$i]= $this->calculate_string($b[$i]); 
                }else{
                    $b[$i]=0;
                }
            }
            if($a[$n1]==0){
                if($b[$n2]==0){
                    $ladathuc=2;
                }else{
                    $ladathuc=1;
                }
            }else if($b[$n2]==0){
                    $ladathuc=3;
            }  else {
                $ladathuc=4;//tat ca da hop le
            }
            if($ladathuc==4){
                if($n1>=$n2){
                    $phanchia=  $this->chiahaidathuc($a, $n1, $b, $n2);//phan chia duoc
                    $nphanchia=  $this->baccuadathuc($phanchia);
                    $phandu=  $this->chiahaidathucdu($a, $n1, $b, $n2);//phan du lai
                    $nphandu=  $this->baccuadathuc($phandu);
                }else{
                    $phanchia[0]=0;
                    $nphanchia=0;
                    $phandu=$a;
                    $nphandu=$n1;
                }
            }
            
        }

        return $this->render('chiadachodathuc',[
            'n1'=>$n1,
            'n2'=>$n2,
            'nphanchia'=>$nphanchia,
            'nphandu'=>$nphandu,
            'a'=>$a,
            'b'=>$b,
            'phanchia'=>$phanchia,
            'phandu'=>$phandu,
            'ladathuc'=>$ladathuc
        ]);
    }
    public function actionDathuccon()
    {
        return $this->render('dathuccon');
    }
    public function actionDothi()
    {
        return $this->render('dothi');
    }
}
