<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<h4 class="huongdan-tieude">
    <span class="prhuongdan">Ứng dụng toán </span>
        Ví dụ cụ thể 
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
if($url=='/matran/markov'){
?>
    <p><b>Cho xích Markov với </b></p>
    $\mathrm{I} = \{0, 1, 2, 3\}\\
    P = \begin{pmatrix}
        0 & \frac{1}{2} & 0  & \frac{1}{2}\\
        0 & 0 & 1  & 0\\
        0 & 0 & 0  & 1\\
        \frac{1}{2} & 0 & 0  & \frac{1}{2}\\
        \end{pmatrix}\\
    $
    <br>
    <br>
    <p> <b>P tối giản </b>do bất kỳ hai trạng thái nào của xích cũng liên thông.
        <b>Hình ảnh</b></p>
    <?= Html::img('@web/img/huongdan/bieudo.svg',['width'=>'100%']) ?>
    <br>
    <p><b>P là phi tuần hoàn </b> do</p>
    <?= Html::img('@web/img/huongdan/toigian.png',['width'=>'100%']) ?>
    <br><br>
    <p> Vì với mọi n > 8 thì tất cả các phần tử $p_{ij}^{(n)} > 0$ vậy $p_{ii}^{(n)} > 0$  $\forall n > 8$.</p>
    <br><br>
    <p><b>Phân phối dừng</b> của xích là </p>
    $
    \begin{cases}
        \pi_0 = \pi_0 0 + \pi_1 0 + \pi_2 0 + \pi_3 \frac{1}{2}\\ 
        \pi_1 = \pi_0 \frac{1}{2} + \pi_1 0 + \pi_2 0 + \pi_3 0\\ 
        \pi_2 = \pi_0 0 + \pi_1 1 + \pi_2 0 + \pi_3 0\\ 
        \pi_3 = \pi_0 \frac{1}{2} + \pi_1 0 + \pi_2 1 + \pi_3 \frac{1}{2}\\ 
        \pi_0 + \pi_1 +\pi_2 +\pi_3 = 1
    \end{cases}
    \Longleftrightarrow
    \begin{cases}
        \pi_0 = \frac{1}{4} = 0.25\\ 
        \pi_1 = \frac{1}{8} = 0.125\\ 
        \pi_2 = \frac{1}{8} = 0.125\\ 
        \pi_3 = \frac{1}{2} = 0.5\\ 
    \end{cases}
    $
    <br><br>
    <p>Đồng thời P là tối giản, phi tuần hoàn nên <b>phân phối giới hạn</b> của xích là</p>
    $
    \\
    \pi 
        =
        \begin{pmatrix}
        0.25 & 0.125 & 0.125  & 0.5\\
        0.25 & 0.125 & 0.125  & 0.5\\
        0.25 & 0.125 & 0.125  & 0.5\\
        0.25 & 0.125 & 0.125  & 0.5\\
        \end{pmatrix}
    $
<?php } ?>
