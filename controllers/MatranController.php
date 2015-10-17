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
    public function actionBieudo(){
        return $this->render('bieudo',[
            
        ]);
    }
            
    public function actionIndex()
    {
        $soan='';
        $conghiem=-1;
        $a=[];
        $b=[];
        $x=[];
        $a_giai=[];
        $b_giai=[];
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
            'a_giai'=>$a_giai,
            'b_giai'=>$b_giai,
            'a'=>$a,
            'b'=>$b,
            'x'=>$x,
            'conghiem'=>$conghiem
        ]);
    }
    public function giaihe($a, $b, $soan){
        $x=[];
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
        return $x;
    }

    public function actionMarkov(){
        $esilon=0.000000001;
        $sobac='';
        $somu=1;
        $p=[];
        $p_luythua=[];
        $phanphoidung=[];
        $markovduoc=-1;
        $dakiemtrapp=-1;
        if(isset($_POST['khoitao'])){
            $markovduoc=-10;
        }
        if(isset($_POST['dakiemtrapp'])){
            $dakiemtrapp=1;
        }
        if(isset($_POST['sobac'])){//thay doi so an, so phuong trinh
            $sobac=$_POST['sobac'];
            for($i=0;$i<$sobac;$i++){//khoi tao ma tran a va b
                $p[$i]=[];
                for($j=0;$j<$sobac;$j++){
                    $p[$i][$j]='';
                }
            }
            if(isset($_POST['p'])){//gan dau vao tu ngoai
                $markovduoc=-1;
                $p=$_POST['p'];
                for($i=0;$i<$sobac;$i++){
                    for($j=0;$j<$sobac;$j++){
                        if($p[$i][$j]!=''){
                            $p[$i][$j]= $this->calculate_string($p[$i][$j]); 
                        }else{
                            $p[$i][$j]=0;
                        }
                    }
                }
                for($i=0;$i<$sobac;$i++){
                    $lamda=0;
                    for($j=0;$j<$sobac;$j++){
                        if($p[$i][$j]<0){
                            $markovduoc=2;//khong phai ma tran xs chuyen
                            break;
                        }  else {
                            $lamda+=$p[$i][$j];
                        }
                    }
                    if($lamda>1+$esilon||$lamda<1-$esilon){
                        $markovduoc=2;//khong phai ma tran xs chuyen
                        break;
                    }
                }
                
            }
            if(isset($_POST['somu'])&&$markovduoc!=2){
                $somu=$_POST['somu'];
                if($somu<0){
                    $markovduoc=0;
                }else{
                    if($somu==0&&$this->matran0($p, $sobac)==TRUE){
                        $markovduoc=0;
                    }  else {
                        $p_luythua=$this->luythua($p, $sobac, $somu);
                        $markovduoc=1;
                    }

                }
            }
            if(isset($_POST['tinhtoigian'])&&!isset($_POST['kiemtrapp'])&&$markovduoc!=2){
                for($i=0;$i<$sobac;$i++){
                    if($this->lienthong($p, $sobac,0, $i)==0){
                        $markovduoc=5;//ma tran khong toi gian
                        break;
                    }
                    
                }
                if($markovduoc!=5){
                    $markovduoc=6;//ma tran toi gian
                }
            }
            if(isset($_POST['phanphoigioihan'])&&!isset($_POST['kiemtrapp'])&&$markovduoc!=2){
                if($markovduoc==6){
                    $p_toigian=[];
                    $p_toigian=$this->luythua($p, $sobac, 2*$sobac+1);
                    for($i=0;$i<$sobac;$i++){
                        for($j=0;$j<$sobac;$j++){
                            if($p_toigian[$i][$j]==0){
                                $markovduoc=7;//ma tran khong toi gian
                                break;
                            }
                        }
                    }
                    if($markovduoc!=7){
                        $markovduoc=8;//ma tran toi gian
                        $p_luythua=$this->luythua($p, $sobac, 30*$sobac);

                    }
                }else{
                    $markovduoc=9;
                }
            }
            if(isset($_POST['phanphoidung'])&&!isset($_POST['kiemtrapp'])&&$markovduoc!=2){//tim phan phoi dung
                $markovduoc=3;
                $tinhdung=0;
                for($i=0;$i<$sobac;$i++){
                    if($p[$i][$i]==1){
                        $tinhdung++;
                    }
                }
                if($tinhdung>1){//xich co nhieu hon mot trang thai hut, vay xich khong dung
                    $markovduoc=4;
                }
                //thuc hien giai he tim pi
                $a_ppd=[];
                $b_ppd=[];
                for($i=0;$i<$sobac;$i++){
                    if($i==0){
                        $b_ppd[$i]=1;
                    }else{
                         $b_ppd[$i]=0;
                    }
                    for($j=0;$j<$sobac;$j++){
                        if($i==0){
                            $a_ppd[$i][$j]=1;
                        }else{
                            if($i==$j){
                                $a_ppd[$i][$j]=$p[$j][$i]-1;
                            }else{
                                $a_ppd[$i][$j]=$p[$j][$i];
                            }
                        }
                    }
                }
                $phanphoidung=  $this->giaihe($a_ppd, $b_ppd, $sobac);
                $phanphoidung=  $this->lamdepketqua($phanphoidung, $sobac, 0);
            }
           
        }
        return $this->render('markov',[
            'sobac'=>$sobac,
            'somu'=>$somu,
            'p'=> $p,
            'p_luythua'=>$p_luythua,
            'markovduoc'=>$markovduoc,
            'phanphoidung'=>$phanphoidung,
            'dakiemtrapp'=>$dakiemtrapp,
        ]);
    }
    public function lienthong($p,$sobac, $trangthai1, $trangthai2){
        $p_lienthong=[];
        $laptoida=2*$sobac+1;
        //dau tien kiem tra trang thai 1-> trang thai 2
        $lienthong=-1;
        for($i=1;$i<$laptoida;$i++){
            $p_lienthong=$this->luythua($p, $sobac,$i);
            if($p_lienthong[$trangthai1][$trangthai2]>0){
                $lienthong=1;
                break;
            }
        }
        // co duong di tu trang thai 1 sang trang thai 2 thi tiep tuc kiem tra nguoc lai
        if($lienthong==1){
            for($i=1;$i<$laptoida;$i++){
                $p_lienthong=$this->luythua($p, $sobac,$i);
                if($p_lienthong[$trangthai2][$trangthai1]>0){
                    $lienthong=2;//lien thong
                    break;
                }
            }
        }
        if($lienthong==2){
            return 1;
        }else{
            return 0;
        }
       
    }

    public function lamdepketqua($matran, $hang, $cot){
        if($cot==0){
            for($i=0;$i<$hang;$i++){
                    if($matran[$i]=='-0'){
                        $matran[$i]=0;
                    }
                }
        }else{
             for($i=0;$i<$hang;$i++){
                    for($j=0;$j<$cot;$j++){
                        if($matran[$i][$j]=='-0'){
                            $matran[$i][$j]=0;
                    }
                }
             }
        }
        return $matran;
    }
    public function actionMatrannghichdao(){
        $sobac='';
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
                if($somu<0&&$sobac>1){
                    if($this->matrandoclap($p, $sobac)==true){
                        if($somu==-1){
                            $p_luythua=  $this->matrannghichdao($p, $sobac);
                        }else{
                            $p_luythua=  $this->matrannghichdao($p, $sobac);
                            $p_luythua=$this->luythua($p_luythua, $sobac, $somu*-1);
                        }
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
        return $this->render('matrannghichdao',[
            'sobac'=>$sobac,
            'somu'=>$somu,
            'p'=> $p,
            'p_luythua'=>$p_luythua,
            'luythuaduoc'=>$luythuaduoc,
        ]);
    }
    public function actionMatran(){
        $sobac='';
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
                if($somu<0&&$sobac>1){
                    if($this->matrandoclap($p, $sobac)==true){
                        if($somu==-1){
                            $p_luythua=  $this->matrannghichdao($p, $sobac);
                        }else{
                            $p_luythua=  $this->matrannghichdao($p, $sobac);
                            $p_luythua=$this->luythua($p_luythua, $sobac, $somu*-1);
                        }
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
    public function actionNhanhaimatran(){
        
        $na='';//so cot cua ma tran a
        $ma='';//so dong cua ma tran a
        $nb='';
        $mb='';
        $a=[];
        $b=[];
        $ab=[];//ma tran ket qua
        $nhanthanhcong=-1;
        if(isset($_POST['ma'])){//thay doi so an, so phuong trinh
            $ma=$_POST['ma'];
            $mb=$na=$_POST['na'];
            $nb=$_POST['nb'];
            for($i=0;$i<$ma;$i++){
                $a[$i]=[];
                for($j=0;$j<$na;$j++){
                    $a[$i][$j]='';
                }
            }
            for($i=0;$i<$mb;$i++){
                $b[$i]=[];
                for($j=0;$j<$nb;$j++){
                    $b[$i][$j]='';
                }
            }
            if(isset($_POST['a'])){
                $a=$_POST['a'];
                $b=$_POST['b'];
                for($i=0;$i<$ma;$i++){
                    for($j=0;$j<$na;$j++){
                        if($a[$i][$j]!=''){
                            $a[$i][$j]= $this->calculate_string($a[$i][$j]); 
                        }else{
                            $a[$i][$j]=0;
                        }
                    }
                }
                for($i=0;$i<$mb;$i++){
                    for($j=0;$j<$nb;$j++){
                        if($b[$i][$j]!=''){
                            $b[$i][$j]= $this->calculate_string($b[$i][$j]); 
                        }else{
                            $b[$i][$j]=0;
                        }
                    }
                }
                $ab=  $this->nhanhaimatran($a, $ma, $na, $b, $nb);
                $nhanthanhcong=1;
            }
        }
        return $this->render('nhanhaimatran',[
            'na'=>$na,
            'ma'=>$ma,
            'nb'=>$nb,
            'mb'=>$mb,
            'a'=>$a,
            'b'=>$b,
            'ab'=>$ab,
            'nhanthanhcong'=>$nhanthanhcong,
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
                        
                    }
                    for($j=0;$j<$sobac;$j++){
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
                        
                    }
                    for($j=0;$j<$sobac;$j++){
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

    public function nhanhaimatran($matran1, $hang1, $cot1, $matran2, $cot2){
        $ketqua=[];
        for($i=0;$i<$hang1;$i++){
            $ketqua[$i]=[];
        }
        for($i=0;$i<$hang1;$i++){
            for($j=0;$j<$cot2;$j++){
                $ketqua[$i][$j]=0;
                for($t=0;$t<$cot1;$t++){
                    $ketqua[$i][$j]+=$matran1[$i][$t]*$matran2[$t][$j];
                }
            }
        }
        return $ketqua;
    }
}
