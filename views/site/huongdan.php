<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<h4 class="huongdan-tieude">
    <span class="prhuongdan">Ứng dụng toán </span>
        Lưu ý nhỏ
    <span class="prhuongdan"> Ứng dụng toán </span>
</h4>
<?php
$url= Url::to();
if($url=='/dathucs'||$url=='/dathuc/index'||$url=='/'){
?>
<h4> <b>Lý thuyết</b> </h4>
    $
        \text{Phương có trình có dạng}\\
        a_nx^n + a_{n-1}x^{n-1} + ... + a_1x + a_0 = 0\\
        \text{Trong đó:}\\
        n:\text{ Là số bậc của phương trình, chính là số mũ cao nhất của x}\\
        a_i:\text{ Là các hệ số thực của phương trình}\\
        \text{Số nghiệm tìm được tối đa của phương trình là n nghiệm}\\
    $
    <h4><b>Ứng dụng toán trong hệ thống này </b></h4>
    <p><b>Bước 1: </b> Đầu tiên bạn nhập số bậc của phương trình,
    để báo cho hệ thống biết và tự tạo ra các hệ số $a_i$ cho bạn nhập. Sau đó 
    bấm vào nút "Phương trình mới" ngay góc trên bên phải màn hình.</p>
    <p><b>Bước 2: </b> Khi các hệ số được tạo ra, bạn chỉ cần nhập các hệ số tương ứng 
    với các số mũ trong bài toán của bạn, nếu những hệ số của số mũ bạn không thấy có
     thì bạn nhập vào giá trị 0, hoặc không nhập. Sau đó bạn ấn vào nút "Tìm nghiệm" 
    và thu được kết quả.</p>
<?php    
}