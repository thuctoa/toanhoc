<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title ="Hướng dẫn và kiến thức nhớ lại";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-3">

            <!-- normal -->
            <div class="ih-item square effect4" >
                <a href="#hephuontrinh" >
                <div class="img"><img src="../../img/hephuongtrinh.png" alt="img" ></div>
                <div class="mask1"></div>
                <div class="mask2"></div>
                <div class="info">
                  <h3>Giải hệ phương trình</h3>
                  <p><?=Yii::t('app','Description goes here')?></p>
                </div></a>
            </div>
            <!-- end normal -->

        </div>
        <div class="col-sm-3">

            <!-- colored -->
            <div class="ih-item square colored effect4"><a href="#luythuamatran">
                <div class="img"><img src="../../img/luythuamatran.png" alt="img"></div>
                <div class="mask1"></div>
                <div class="mask2"></div>
                <div class="info">
                  <h3>Lũy thừa ma trận</h3>
                  <p><?=Yii::t('app','Description goes here')?></p>
                </div></a>
            </div>
            <!-- end colored -->

        </div>
        <div class="col-sm-3">

            <!-- colored -->
            <div class="ih-item square colored effect4"><a href="#nhanhaimatran">
                <div class="img"><img src="../../img/nhanhaimatran.png" alt="img"></div>
                <div class="mask1"></div>
                <div class="mask2"></div>
                <div class="info">
                  <h3>Nhân hai ma trận</h3>
                  <p><?=Yii::t('app','Description goes here')?></p>
                </div></a>
            </div>
            <!-- end colored -->

        </div>
        <div class="col-sm-3">

            <!-- colored -->
            <div class="ih-item square colored effect4"><a href="#nghichdaomatran">
                <div class="img"><img src="../../img/matrannghichdao.png" alt="img"></div>
                <div class="mask1"></div>
                <div class="mask2"></div>
                <div class="info">
                  <h3>Tính ma trận nghịch đảo</h3>
                  <p><?=Yii::t('app','Description goes here')?></p>
                </div></a>
            </div>
            <!-- end colored -->

        </div>
    </div>
    <div id="hephuongtrinh" class="huongdan">
        <h2>Giải hệ phương trình tuyến tính</h2>
        Ví dụ ta giải một hệ sau
        $\begin{cases}
            3x + 5y + z = 9\\
            7x - 2y + 4z = 9 \\
            -6x + 3y + 2z =-1 
        \end{cases}$ lúc này ta chuyển hệ về dạng ma trận tổng quát
        $ Ax =B$, có nghĩa là
        $\begin{cases}
            a_\text{00}x_0 + a_\text{01}x_1 + a_\text{02}x_2 = b_0\\
            a_\text{10}x_0 + a_\text{11}x_1 + a_\text{12}x_2 = b_1\\
            a_\text{20}x_0 + a_\text{21}x_1 + a_\text{22}x_2 = b_2\\
        \end{cases}$
        hay,
        $$
        \begin{bmatrix}
            a_\text{00} & a_\text{01} &  a_\text{02}\\
            a_\text{10} & a_\text{11} &  a_\text{12}\\
            a_\text{20} & a_\text{21} &  a_\text{22}\\
        \end{bmatrix}
        \begin{bmatrix}
            x_0\\
            x_1\\
            x_2\\
        \end{bmatrix}
        =
        \begin{bmatrix}
            b_0\\
            b_1\\
            b_2\\
        \end{bmatrix}
        $$
        Ở dạng tổng quát này máy tính sẽ giải bằng thuật toán Gauss-Jordan với dạng ma trận mở rộng
        $$ 
        \begin{bmatrix}
            a_\text{00} & a_\text{01} &  a_\text{02} & | & b_0\\
            a_\text{10} & a_\text{11} &  a_\text{12} & | & b_1\\
            a_\text{20} & a_\text{21} &  a_\text{22} & | & b_2\\
        \end{bmatrix}
        $$
        Qua một số bước biến đổi sơ cấp nếu hệ có nghiệm duy nhất thì ma trận mở rộng có dạng
        $$\begin{bmatrix}
            a_\text{00}^\text{'} & a_\text{01}^\text{'} &  a_\text{02}^\text{'} & | & b_0^\text{'}\\
            0 & a_\text{11}^\text{'} &  a_\text{12}^\text{'} & | & b_1^\text{'}\\
            0 & 0 &  a_\text{22}^\text{'} & | & b_2^\text{'}\\
        \end{bmatrix}$$
        Cuối cùng tính ngược từ dưới lên ta thu được nghiệm của bài toán $$\{x_0, x_1,x_2\}$$
        Như ví dụ trên thì  
        $\begin{cases}
            a_\text{00}=3\\
            a_\text{01}=5\\
            a_\text{02}=1\\
            b_0=9\\
            a_\text{10}=7\\
            a_\text{11}=-2\\
            a_\text{12}=4\\
            b_1=9\\
            a_\text{20}=-6\\
            a_\text{21}=3\\
            a_\text{22}=2\\
            b_2=-1\\
        \end{cases}$, Sau đó ta nhập các hệ số <a  href="/matran/index">ở đây</a> ta sẽ thu được kết quả.
    </div>
    <div id="luythuamatran" class="huongdan">
        <h2>Lũy thừa ma trận</h2>
        Trong thực tế việc ta có một ma trận và cần tìm lũy thừa của nó n lần, như các bài toán hồi quy, markov thì việc tìm 
        ma trận phân phối xác suất sau n bước, chính là ma trận phân phối xác suất chuyển mũ n. Lúc này ma trận cần được lũy thừa 
        Ta áp dụng thuật toán nhân và bình phương liên tiếp, nhằm giảm độ phức tạp của thuật toán lũy thừa thông thường.
        Với thuật toán nhân thì ta dùng thuật toán nhân hai ma trận của Strassen 1960 (Ở mục nhân hai ma trận).
        <br>Ví dụ ta cần tính 
       
        $$
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}^7
        =
        \begin{pmatrix}
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}
        \end{pmatrix}^2
        \begin{pmatrix}
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}
        \end{pmatrix}
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}
        $$
        Nói rõ hơn, thì ban đầu ta đặt 
        $$
            A_0=
            \begin{bmatrix}
                a_\text{00}  & \cdots & a_\text{0n}  \\
                \vdots & \ddots & \vdots \\
                a_\text{n0}& \cdots & a_\text{nn}
            \end{bmatrix}
        $$
        Sau đó bình phương $A_0$ thu được $A_1$ 
        $$
            A_1=A_0^2=
            \begin{bmatrix}
                a_\text{00}  & \cdots & a_\text{0n}  \\
                \vdots & \ddots & \vdots \\
                a_\text{n0}& \cdots & a_\text{nn}
            \end{bmatrix}
            \begin{bmatrix}
                a_\text{00}  & \cdots & a_\text{0n}  \\
                \vdots & \ddots & \vdots \\
                a_\text{n0}& \cdots & a_\text{nn}
            \end{bmatrix}
        $$
        Kiểm tra 2 vẫn bé hơn 7 ta tiếp tục tính $A_2=A_1^2$ tới đây ta thu được kết quả.
        $$A_0^7=A_0^2A_0^2A_0^2A_0=A_1A_1A_1A_0=A_2A_1A_0$$
        Vậy đáng lẽ ra ta phải mất tới 6 phép nhân ma trận cho việc tính $A_0^7$, thì giờ đây
        ta chỉ tiêu tốn cho một phép tính $A_1$ là $A_0^2$, một phép tính $A_2$ là $A_1^2$ và hai phép cho $A_2A_1A_0$
        là ta đã tính được $A_0^7$ chỉ mất có 4 phép nhân. Vì vậy giúp thời gian tìm ra kết quả của máy tính bị giảm xuống.
        Hay là việc tính toán được nhanh hơn, bằng việc chi trả không gian lưu trữ các biến trung gian là 
        $A_2$ và $A_1$.
        <br>
        Còn đối với số mũ nhỏ hơn 0 $( m < 0)$thì ta có
        $$
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}^m
        = 
        \begin{pmatrix}
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}^{-1}
        \end{pmatrix}^{-m}
        $$
        Vậy để ma trận có lũy thừa âm thì ma trận đó phải khả nghịch, sau đó ta tính ma trận 
        nghịch đảo của nó rồi áp dụng lũy thừa dương như ở trên ta được ma trận kết quả.
        <br>Mời bạn <a  href="/matran/matran">click vào đây</a> để thực hiện tính lũy thừa ma trận của mình.
        
       
    </div>
    <div id="nhanhaimatran" class="huongdan">
        <h2>Nhân hai ma trận</h2>
        Ta áp dụng thuật toán của Strassen, giúp ích cho việc độ phức tạp của phép nhân giảm xuống
        so với cách nhân thông thường, điều này giúp cho việc có thể tìm được các ma trận lũy thừa cao hơn phục vụ cho việc tìm
        ma trận giới hạn của chúng. Ví dụ ta tính C= AB tổng quát.
        $$
        \begin{bmatrix}
            C_\text{00} & C_\text{01}\\
            C_\text{10} & C_\text{11}\\
        \end{bmatrix}
        =
        \begin{bmatrix}
            A_\text{00} & A_\text{01}\\
            A_\text{10} & A_\text{11}\\
        \end{bmatrix}
        \begin{bmatrix}
            B_\text{00} & B_\text{01}\\
            B_\text{10} & B_\text{11}\\
        \end{bmatrix}
        $$
        Thay vì việc tính theo thuận toán chia để trị.
        $$
        \begin{cases}
            C_\text{00} = A_\text{00}B_\text{00}+A_\text{01}B_\text{10}\\
            C_\text{01} = A_\text{00}B_\text{01}+A_\text{01}B_\text{11}\\
            C_\text{10} = A_\text{10}B_\text{00}+A_\text{11}B_\text{10}\\
            C_\text{11} = A_\text{10}B_\text{01}+A_\text{11}B_\text{11}\\
        \end{cases}
        $$
        Dẫn đến công thức truy hồi tính độ phức tạp của thuật toán là $T(n)=8T(n/2)+O(n^2)=O(n^3)$.
        <br>Bây giờ ta áp dụng thuật toán của Strassen là
        $$\begin{cases}
            M_0=(A_\text{01}-A_\text{11}) (B_\text{10}+B_\text{11})\\
            M_1=(A_\text{00}+A_\text{11}) (B_\text{00}+B_\text{11})\\
            M_2=(A_\text{00}-A_\text{10}) (B_\text{00}+B_\text{01})\\
            M_3=(A_\text{00}+A_\text{01}) B_\text{11}\\
            M_4=A_\text{00} (B_\text{01}-B_\text{11})\\
            M_5=A_\text{11} (B_\text{10}-B_\text{00})\\
            M_6=(A_\text{10}+A_\text{11})B_\text{00}\\
            
        \end{cases}$$
        Lúc này 
        $$
        \begin{cases}
            C_\text{00} = M_0 + M_1-M_3 + M_5\\
            C_\text{01} = M_3+M_5\\
            C_\text{10} = M_5+M_6\\
            C_\text{11} = M_1-M_2+M_4-M_6\\
        \end{cases}
        $$
        Thuật toán này đã rút bớt đi một phép nhân so với thuật toán trên xuống còn 7 phép nhân. Việc làm
        này cũng cải thiện đáng kể về thời gian ra kết quả, vì các phần tử tổng quát ở đây là các ma trận,
        và được tính theo công thức đệ quy. Với độ phức tạp là $T(n)=O(n^{log_2^7})< O(n^3)$.
        Mời bạn tính tích của hai ma trận <a  href="/matran/nhanhaimatran">ở đây</a>
    </div>
    <div id="nghichdaomatran" class="huongdan">
        <h2>Ma trận nghịch đảo</h2>
        Sử dụng phương pháp Gauss-Jordan để ta tính ma trận nghịch đảo của ma trận
        $$
        A=
        \begin{bmatrix}
            a_\text{00}  & \cdots & a_\text{0n}  \\
            \vdots & \ddots & \vdots \\
            a_\text{n0}& \cdots & a_\text{nn}
        \end{bmatrix}
        $$
        Bằng cách ta thêm n cột và ma trận A để được ma trận $\bar{A}$ như sau
        $$
        \bar{A}=
        \begin{bmatrix}
            a_\text{00}  & a_\text{01}  & \cdots & a_\text{0n} & | & 1  & 0 & \cdots & 0  \\
            a_\text{10}  & a_\text{11}  & \cdots & a_\text{1n} & | & 0  & 1 & \cdots & 0  \\
            \vdots & \ddots & \vdots & \vdots & | & \vdots & \ddots & \vdots & \vdots \\
            a_\text{n0}  & a_\text{n1} & \cdots & a_\text{nn} & | & 0  & 0 & \cdots & 1  \\
            
        \end{bmatrix}
        $$
        Sau một số phép biến đổi sơ cấp ta biến $\bar{A}$ về dạng
        $$
        \bar{A} 
        \longrightarrow
        \begin{bmatrix}
            1  & 0 & \cdots & 0 & | & a_\text{00}^{'}  & a_\text{01}^{'}  & \cdots & a_\text{0n}^{'}\\
            0  & 1 & \cdots & 0 & | & a_\text{10}^{'}  & a_\text{11}^{'}  & \cdots & a_\text{1n}^{'}\\
            \vdots & \ddots & \vdots & \vdots & | & \vdots & \ddots & \vdots & \vdots  \\
            0  & 0 & \cdots & 1 & | & a_\text{n0}^{'}  & a_\text{n1}^{'} & \cdots & a_\text{nn}^{'}  \\
            
        \end{bmatrix}
        $$
        Nếu làm được việc trên, thì ma trận A là khả nghịch và có ma trận nghịch đảo là
        $$
            A^{-1}=
            \begin{bmatrix}
                a_\text{00}^{'}  & \cdots & a_\text{0n}^{'}  \\
                \vdots & \ddots & \vdots \\
                a_\text{n0}^{'}& \cdots & a_\text{nn}^{'}
            \end{bmatrix}
        $$
        Mời bạn tìm ma trận nghịch đảo của ma trận <a  href="/matran/matrannghichdao">ở đây</a>
    </div>
</div>
