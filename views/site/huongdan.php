<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<h2 class="huongdan-tieude">
    <span class="prhuongdan"> Ứng dụng toán </span>
        Lưu ý nhỏ
    <span class="prhuongdan"> Ứng dụng toán </span>
</h2>
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
if($url=='/matran/markov'){
?>
    <p><b>1. Liên thông hai trạng thái $i$ và $j$ </b></p>
    <p>Ta nói rằng trạng thái $i$ đến được trạng thái $j$ và ký hiệu là  $ i \longrightarrow j$ 
     nếu tồn tại $ n \geqslant 0 $ sao cho $p_{ij}^{(n)} > 0.$
    Hai trạng thái $i$ và $j$ được gọi là liên thông và ký hiệu là $i \longleftrightarrow j$ 
     nếu $ i \longrightarrow j$ và $ j \longrightarrow i$.</p>
    <p><b>2. Xích tối giản, ma trận tối giản </b></p>
    <p> Một xích Markov được gọi là tối giản nếu hai trạng thái bất kì đều liên thông với nhau
    . Ma trận chuyển P được gọi là tối giản nếu xích Markov tương ứng với nó là tối giản.</p>
    <p><b>3. Phân phối dừng </b></p>
    <p> Phân phối $\pi = (\pi_i)_{i \in I }$ trên không gian trạng thái $I$ được gọi là dừng 
        với ma trận chuyển P nếu <br>
        $$
            \pi = \pi P, \\
        $$
        tức là
        $$
            \pi_i = \sum_{i \in I}\pi_j p_{ji} 
            \begin{matrix}
            & 
            \end{matrix} 
            \forall i \in I.
        $$
    </p>
    <p><b>3. Phi tuần hoàn </b></p>
    <p> Trạng thái $i$ được gọi là phi tuần hoàn nếu $p_{ii}^{(n)}>0$ với mọi n đủ lớn. 
    </p>
    <p><b>4. Phân phối giới hạn </b></p>
    <p>
        Giả sử P là tối giản, phi tuần hoàn và có phân phối dừng là $\pi$. Giả sử λ là phân 
        phối bất kỳ và $(X_n)_{n \geqslant 0}$ là Markov (λ, P). Khi đó với mọi trạng thái $j$, ta có
        $$
            \lim_{n \to \infty} \mathbb{P}(X_n = j) = \pi_j.
        $$
        Đặc biệt với mọi cặp trạng thái $i, j$ ta có
        $$
            \lim_{n \to \infty} p_{ij}^{(n)} = \pi_j.
        $$
    </p>
<?php
}
if($url=='/dathuc/luythuadathuc'||$url=='/dathuc/nhanhaidathuc'||$url=='/dathuc/chiadachodathuc'){
?>
    <h2>Ứng dụng toán</h2>
    Phục vụ cho việc tính toán hoặc kiểm tra kết quả của phép tính toán của bạn.<br>
    Các hệ số tính toán được đều dướ dạng số thập phân.
    
<?php
}