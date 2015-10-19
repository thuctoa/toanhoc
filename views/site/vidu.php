<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<h4 class="huongdan-tieude">
    <span class="prhuongdan">Ứng dụng toán </span>
        Ví dụ 
    <span class="prhuongdan"> Ứng dụng toán </span>
</h4>
<?php
$url= Url::to();
if($url=='/dathucs'||$url=='/dathuc/index'||$url=='/'){
?>
<h4><b>Ví dụ ta có phương trình như sau </b></h4>
    $x^6+x^5-10x^4+9x^2-x-1=0\\$
    <p><b>Bước 1: </b> Ở đây thì ta thấy rằng số mũ cao nhất là 6, vậy bậc của phương trình là 6 </p>
    <p><b>Bước 2: </b> 
        Các hệ số là
        $
            \begin{cases}
                a_6 = 1\\
                a_5 = 1\\
                a_4 = -10\\
                a_3 = 0 & \text{( do không có }  x^3 \text{ trong phương trình)}\\
                a_2 = 9\\
                a_1 = -1\\
                a_0 = -1\\
            \end{cases}
        $
    </p>
    <p><b>Hình ảnh: </b> </p>
<?php
        echo Html::img('@web/img/huongdan/phuongtrinh.png',['width'=>'100%']) ;
    
}